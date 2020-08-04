#!/bin/bash
pushd /moodle/moodle-docker >/dev/null
export MOODLE_DOCKER_DB=pgsql
export MOODLE_DOCKER_WWWROOT=/moodle/moodle-39
export MOODLE_DOCKER_WEB_HOST=0.0.0.0
export MOODLE_DOCKER_WEB_PORT=0.0.0.0:8000
export ASSETDIR="$(pwd)/assets"
export MOODLE_DOCKER_PHP_VERSION=7.2
cp config.docker-template.php $MOODLE_DOCKER_WWWROOT/config.php
docker-compose -f base.yml -f webserver.port.yml up -d webserver
bin/moodle-docker-wait-for-db
popd >/dev/null