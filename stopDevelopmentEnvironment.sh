#!/bin/bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
pushd $DIR >/dev/null
docker-compose -p moodle_block_tog_services_dev -f docker/dev/docker-compose.yml down --remove-orphans
docker stop moodle_block_tog_dev
docker rm moodle_block_tog_dev
popd >/dev/null