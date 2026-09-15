#!/usr/bin/env bash
# Inputs (env): DEPLOYMENT_MATRIX, REF_NAME, ENV_OVERRIDE. Output: DEPLOYMENT_MATRIX in $GITHUB_OUTPUT.
set -euo pipefail

if [ -z "${DEPLOYMENT_MATRIX:-}" ]; then
  echo "::error::DEPLOYMENT_MATRIX variable is empty. Set it in GitHub Variables as a JSON array."
  exit 1
fi
if ! echo "$DEPLOYMENT_MATRIX" | jq -e 'if type == "array" and length > 0 then . else error end' > /dev/null 2>&1; then
  echo "::error::DEPLOYMENT_MATRIX must be a non-empty JSON array."
  exit 1
fi

TARGET_ENV=""
SOURCE=""
if [ -n "${ENV_OVERRIDE:-}" ]; then
  SOURCE="workflow_dispatch input"
  if [ "$ENV_OVERRIDE" = "all" ]; then
    TARGET_ENV=""
  else
    TARGET_ENV="$ENV_OVERRIDE"
  fi
else
  SOURCE="branch '${REF_NAME:-<none>}'"
  case "${REF_NAME:-}" in
    master) TARGET_ENV="production" ;;
    dev)    TARGET_ENV="testing" ;;
    "")     TARGET_ENV="" ;;
    *)
      echo "::error::Branch '${REF_NAME}' is not mapped to any environment (expected master or dev). Nothing to deploy."
      exit 1
      ;;
  esac
fi

if [ -n "$TARGET_ENV" ]; then
  FILTERED="$(echo "$DEPLOYMENT_MATRIX" | jq --arg env "$TARGET_ENV" '[.[] | select(.enabled != false and .environment == $env)]')"
else
  FILTERED="$(echo "$DEPLOYMENT_MATRIX" | jq '[.[] | select(.enabled != false)]')"
fi

# Default php_binary so matrix jobs can use it unconditionally.
FILTERED="$(echo "$FILTERED" | jq -c '[.[] | .php_binary = (.php_binary // "php")]')"

if [ "$(echo "$FILTERED" | jq 'length')" -eq 0 ]; then
  echo "::error::No enabled servers match environment '${TARGET_ENV:-<any>}' (source: ${SOURCE})."
  exit 1
fi

echo "Deploying $(echo "$FILTERED" | jq -r '[.[].name] | join(", ")') (environment: ${TARGET_ENV:-all}; source: ${SOURCE})"

delimiter="$(openssl rand -hex 8)"
{
  echo "DEPLOYMENT_MATRIX<<${delimiter}"
  echo "$FILTERED"
  echo "${delimiter}"
} >> "${GITHUB_OUTPUT}"
