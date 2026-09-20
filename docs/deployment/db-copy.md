# Copying the production database (and runtime files) manually

Commands used to copy `digispace.pro` production data to the local Sail stack and to the testing site `t-digi-space.inf.ua`, plus restoring `public/uploads` on production.

## Access cheat-sheet

| Target | SSH user | Host | Port | Purpose |
|---|---|---|---|---|
| prod site (CloudPanel) | `digispace` | `138.201.196.61` | `2226` | owns `htdocs`, `public/uploads` etc. |
| prod deploy user | `digispace-main` | `138.201.196.61` | `2226` | owns `releases/`, `current` symlink target |
| testing site | `t-digi-space` | `138.201.196.61` | `2226` | owns `htdocs` |
| testing deploy user | `testdigispace` | `138.201.196.61` | `2226` | owns `releases/` |

SSH key: `~/.ssh/github-actions` (the deploy key, authorized for all four users).

```bash
SSH="ssh -i ~/.ssh/github-actions -p 2226 -o IdentitiesOnly=yes -o BatchMode=yes"
```

### Gotchas

- `current` under `~/htdocs/<domain>` of the *site* user is a symlink into the *deploy* user's `releases/` (e.g. `/home/digispace-main/htdocs/digispace.pro/releases/<sha>-<run>`). Write files as the site user (`digispace`); the deploy user has no write permission on `public/*` dirs (owned `digispace:digispace`, mode `750`).
- `.env` lives at `~/htdocs/<domain>/.env` (site user) and is also symlinked into each release via `current/.env`. The deploy user's copy under `/home/<deploy-user>/htdocs/<domain>/.env` is the live one.
- `DB_PASSWORD` in `.env` may be **quoted** (`DB_PASSWORD="..."`) — strip quotes before using with `mysql`/`mysqldump` or you get `Access denied`.

## 1. Dump the production DB

```bash
$SSH digispace@138.201.196.61 'cd ~/htdocs/digispace.pro && \
  DB_NAME=$(grep "^DB_DATABASE" .env | cut -d= -f2-) && \
  DB_USER=$(grep "^DB_USERNAME" .env | cut -d= -f2-) && \
  DB_PASS=$(grep "^DB_PASSWORD" .env | cut -d= -f2- | sed "s/^[\"'"'"']//; s/[\"'"'"']\$//") && \
  mysqldump --single-transaction --quick --routines --triggers \
    -h127.0.0.1 -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" \
  | gzip -9 > ~/digispace-db-prod.sql.gz && ls -la ~/digispace-db-prod.sql.gz'
```

Download it:

```bash
scp -i ~/.ssh/github-actions -P 2226 -o IdentitiesOnly=yes -o BatchMode=yes \
  digispace@138.201.196.61:~/digispace-db-prod.sql.gz /tmp/digispace-db-prod.sql.gz
```

## 2. Import into the local Sail DB

**This fully replaces the local `laravel` database.**

```bash
gunzip -c /tmp/digispace-db-prod.sql.gz \
  | vendor/bin/sail exec -T digi-space-db mysql -usail -ppassword laravel

# prod's migrations table doesn't know about newer dev migrations — apply them:
vendor/bin/sail exec -T digi-space-app php artisan migrate --no-interaction
```

Verify:

```bash
vendor/bin/sail exec -T digi-space-app php artisan tinker --execute \
  'echo App\Models\Post::count()." posts, ".App\Models\Page::count()." pages\n";'
```

## 3. Import into the testing server DB (`t-digi-space.inf.ua`)

Upload the dump, import into `testdigispace`, then migrate inside the current release:

```bash
scp -i ~/.ssh/github-actions -P 2226 -o IdentitiesOnly=yes -o BatchMode=yes \
  /tmp/digispace-db-prod.sql.gz t-digi-space@138.201.196.61:~/digispace-db-prod.sql.gz

$SSH t-digi-space@138.201.196.61 'cd ~/htdocs/t-digi-space.inf.ua/current && \
  DB_NAME=$(grep "^DB_DATABASE" .env | cut -d= -f2-) && \
  DB_USER=$(grep "^DB_USERNAME" .env | cut -d= -f2-) && \
  DB_PASS=$(grep "^DB_PASSWORD" .env | cut -d= -f2- | sed "s/^[\"'"'"']//; s/[\"'"'"']\$//") && \
  DB_HOST=$(grep "^DB_HOST" .env | cut -d= -f2-) && \
  gunzip -c ~/digispace-db-prod.sql.gz \
    | mysql -h"${DB_HOST:-127.0.0.1}" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" && \
  php artisan migrate --force --no-interaction'
```

Read creds from `current/.env` (the live symlink), not the sibling `.env` — they can differ.

## 4. Restore runtime files on production (`public/uploads`, `images`, `banners`)

The deploy workflow backs up `current/public/{images,uploads,banners}` → restores them into each new release. If they were empty when a deploy ran, the content is lost — local `public/` is the source of truth.

Upload as the **site user** (owner), not the deploy user:

```bash
rsync -avz --chmod=Du=rwx,Dg=rwx,Do=rx,Fu=rw,Fg=rw,Fo=r \
  -e "ssh -i ~/.ssh/github-actions -p 2226 -o IdentitiesOnly=yes -o BatchMode=yes" \
  public/uploads/ digispace@138.201.196.61:~/htdocs/digispace.pro/current/public/uploads/

# same pattern for images/banners if ever needed:
# public/images/  → .../current/public/images/
# public/banners/ → .../current/public/banners/
```

Verify:

```bash
curl -s -o /dev/null -w "%{http_code}\n" https://digispace.pro/uploads/widgets/1687122819.jpg
```

## 5. Cleanup

Remove dumps from servers when done:

```bash
$SSH digispace@138.201.196.61     'rm -f ~/digispace-db-prod.sql.gz'
$SSH t-digi-space@138.201.196.61 'rm -f ~/digispace-db-prod.sql.gz'
```
