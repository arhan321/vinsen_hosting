#!/usr/bin/env bash

set -Eeuo pipefail

XDEBUG_INI="/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini"
XDEBUG_SO="$(php-config --extension-dir)/xdebug.so"

if [[ "${XDEBUG:-false}" == "true" && -f "${XDEBUG_SO}" ]]; then
    rm -f "${XDEBUG_INI}"
    docker-php-ext-enable xdebug >/dev/null

    {
        printf '%s\n' 'xdebug.mode=debug,develop'
        printf '%s\n' 'xdebug.start_with_request=yes'
        printf 'xdebug.client_host=%s\n' "${XDEBUG_CLIENT_HOST:-${REMOTE_HOST:-host.docker.internal}}"
        printf 'xdebug.client_port=%s\n' "${XDEBUG_CLIENT_PORT:-9003}"
    } >> "${XDEBUG_INI}"
else
    rm -f "${XDEBUG_INI}"
fi

if [[ "${RUN_SCHEDULER:-false}" == "true" ]]; then
    service cron start
fi

exec "$@"