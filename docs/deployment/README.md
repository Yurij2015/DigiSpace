---
type: Guide
title: "Deployment"
description: "Actual GitHub Actions release sequence, persistence boundaries and rollback considerations."
tags: [deployment, github-actions, cloudpanel]
status: stable
stale_after: 2027-03-13
---

# Deployment

The source of truth is [deploy.yml](../../.github/workflows/deploy.yml) and the server matrix in `deployment-config.json`. This is a source review; no deployment or server verification was performed.

## Trigger and prerequisites

A push to `master` runs the deployment across entries in the configured server matrix. The active `deployment-config.json` currently contains only the testing target; add a reviewed production entry when production deployment is intentionally re-enabled. There is no test job or manual environment approval in this workflow. The existing configuration targets CloudPanel hosts and invokes PHP 8.2 for migrations. Do not copy server addresses, usernames or paths into public documentation; `example.deployment-config.json` describes the matrix fields.

Required GitHub secrets are `SSH_KEY_2` for SCP/SSH and `LARAVEL_ENV` for initial environment provisioning. Servers need PHP and its required extensions, database connectivity, a web root targeting `current/public`, writable shared storage and sufficient space for releases and image backups.

## Implemented sequence

1. **Build:** check out the revision, install Composer dependencies with `--no-dev`, run `npm install` and `npm run build`. Explicit PHP 8.2 setup occurs after Composer installation. The tarball is made from shell `*`, so top-level dotfiles are not included. `vendor` and `public/build` are included; `node_modules` is excluded.
2. **Prepare:** upload the artifact and extract into `releases/<sha>`. Remove its bundled storage directory and create shared `storage` directories. The workflow currently applies mode `0777` recursively.
3. **Before hooks:** copy the existing base `.env` to `.env_prev` and copy active `public/images`, `public/uploads`, `public/banners` into separate backup directories. Then run the server's `beforeHooks` (currently empty).
4. **Activate:** write `LARAVEL_ENV` into base `.env`, link it to the release, then restore `.env_prev` if present. Therefore an existing server environment wins over the secret. Link shared storage and switch `current` to the new release.
5. **After hooks:** restore images into the now-active release, remove image backup directories, then run each configured `afterHooks`. Current hooks invoke `artisan migrate` with PHP 8.2; they do not include `--force`.
6. **Cleanup:** intends to retain the newest five releases and artifacts using modification-time ordering. `ARTIFACTS_PATH` is declared as a step environment variable but omitted from the SSH action's `envs` list; verify remote behavior before relying on artifact cleanup.

```text
<base>/
  .env
  .env_prev
  storage/
  releases/<sha>/
    .env -> <base>/.env
    storage -> <base>/storage
    public/build/
    public/images/   (copied after activation)
    public/uploads/  (copied after activation)
    public/banners/  (copied after activation)
  current -> releases/<sha>
  artifacts/
```

## Operational limitations

This is a release-symlink deployment, but uninterrupted availability is not established: `current` switches before image restoration and migrations. Missing destination directories can affect image copying. The workflow has no application health gate, automatic rollback, deployment concurrency group or database backup. Remote scripts do not explicitly enable fail-fast shell behavior.

Migration hooks without `--force` can refuse to run in a noninteractive production environment. Verify job output and migration status instead of treating symlink activation as deployment success. Changes to the workflow should be reviewed as a separate implementation task.

Only `.env`, shared `storage` and the three copied image directories have explicit persistence handling. S3 objects are external. Zoho's relative token/log files and other runtime files at the release root are not covered. `.env_prev` and image copies are not database backups.

## Verification after an authorized deployment

Check the active revision, readable environment/storage links, migration output and HTTP responses for home, blog, a menu-backed page, login and admin assets. Confirm a sample local image and S3 image loads. Inspect application logs and scheduler configuration. Test lead creation only with an explicitly intended test submission because it writes to Zoho.

## SSH troubleshooting with Proxmox and CloudPanel

The testing target may be a CloudPanel VM behind Proxmox. In the current layout,
the public SSH endpoint is forwarded as:

```text
<PROXMOX_PUBLIC_IP>:2226 → Proxmox DNAT → <CLOUDPANEL_VM_IP>:22 (CloudPanel VM)
```

When deployment fails at the SCP/SSH upload step, check Hetzner and CloudPanel
firewalls, then verify the Proxmox DNAT and `FORWARD` rules, followed by `sshd`
and UFW inside the VM. Fail2ban on the VM can ban the Proxmox bridge address
(`<PROXMOX_BRIDGE_IP>`) after repeated failed login attempts. A ban produces SYN
packets in the VM's tcpdump with no SYN-ACK response and appears in:

```bash
sudo fail2ban-client status sshd
```

Remove an accidental bridge ban with:

```bash
sudo fail2ban-client set sshd unbanip <PROXMOX_BRIDGE_IP>
```

After confirming the private network is controlled, consider adding the trusted
bridge IP to the `sshd` jail's `ignoreip` list. Do not disable Fail2ban globally.

Useful Proxmox checks:

```bash
sudo iptables -t nat -L PREROUTING -n -v | grep 2226
sudo iptables -L FORWARD -n -v | grep <CLOUDPANEL_VM_IP>
nc -vz <CLOUDPANEL_VM_IP> 22
```

Run VM-side checks from the CloudPanel console, not from the Proxmox host:

```bash
hostname
sudo ss -lntp | grep ':22'
sudo ufw status verbose
```

## Rollback procedure

There is no automated rollback job. Before any manual rollback:

1. Identify the active release and an intact previous release; retain the active path for recovery.
2. Determine whether the older code is compatible with migrations already applied. Code rollback does not revert the shared database or `.env`; use a reviewed database recovery plan for incompatible changes.
3. Verify the candidate's built assets, environment/storage links and local image files. Restore missing images from a verified copy before exposing it.
4. Switch `current` to that verified release using the server's established symlink procedure, then repeat the HTTP and log checks above. Handle PHP process/opcache refresh according to server configuration.

Do not run `migrate:rollback` blindly: historical data migrations include empty or missing reverse operations. Do not rerun seeders as rollback; `UserSeeder` deletes existing users.

[Documentation index](../README.md)
