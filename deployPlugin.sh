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
#SERVER_HOST=10.10.200.131
SERVER_USER="root@$SERVER_HOST"
SERVER_ADDR="$SERVER_USER:$SERVER_PATH"
rsync --exclude '.git/' --exclude 'node_modules' --exclude 'version.php' -avzp ./ $SERVER_ADDR --delete-after
ssh $SERVER_USER "chown -R bruno:daemon $SERVER_PATH"
ssh $SERVER_USER "chmod -R g+w $SERVER_PATH"
popd >/dev/null
