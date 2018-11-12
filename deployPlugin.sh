#!/bin/bash
SOURCE="${BASH_SOURCE[0]}"
while [ -h "$SOURCE" ]; do
  DIR="$( cd -P "$( dirname "$SOURCE" )" >/dev/null && pwd )"
  SOURCE="$(readlink "$SOURCE")"
  [[ $SOURCE != /* ]] && SOURCE="$DIR/$SOURCE"
done
DIR="$( cd -P "$( dirname "$SOURCE" )" >/dev/null && pwd )"
pushd $DIR >/dev/null
SERVER_PATH=/var/lib/docker/volumes/root_moodle_data/_data/moodle/blocks/task_oriented_groups
SERVER_HOST=192.168.1.55
SERVER_ADDR="root@$SERVER_HOST:$SERVER_PATH"
rsync -avzp ./ $SERVER_ADDR --delete-after
popd >/dev/null
