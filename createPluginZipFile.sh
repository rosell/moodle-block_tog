#!/bin/bash
SOURCE="${BASH_SOURCE[0]}"
while [ -h "$SOURCE" ]; do
  DIR="$( cd -P "$( dirname "$SOURCE" )" >/dev/null && pwd )"
  SOURCE="$(readlink "$SOURCE")"
  [[ $SOURCE != /* ]] && SOURCE="$DIR/$SOURCE"
done
DIR="$( cd -P "$( dirname "$SOURCE" )" >/dev/null && pwd )"
pushd $DIR >/dev/null

VERSION="$(date '+%Y%m%d')00"
OLD_VERSION=$(cat version.php|grep "version = "| grep -o -E '[0-9]+')
while [ $VERSION -le $OLD_VERSION ]
do
 VERSION=$((VERSION+1))
done
sed -i '' -e "s/version = $OLD_VERSION/version = $VERSION/g" version.php

grunt amd
PLUGIN_FILE="block_task_oriented_groups_moodle35_$VERSION.zip"
DOWNLOAD_DIR="$HOME/Downloads"
if [ -d "$DOWNLOAD_DIR" ]; then
  PLUGIN_DIR="$DOWNLOAD_DIR"
else
 PLUGIN_DIR="/tmp"
fi

PLUGIN_FILE="$PLUGIN_DIR/$PLUGIN_FILE"

TMP_DIR=$(mktemp -d)
mkdir $TMP_DIR/moodle-block_task_oriented_groups
cp *.md $TMP_DIR/moodle-block_task_oriented_groups/.
cp *.php $TMP_DIR/moodle-block_task_oriented_groups/.
cp *.css $TMP_DIR/moodle-block_task_oriented_groups/.
cp -r amd $TMP_DIR/moodle-block_task_oriented_groups/.
cp -r classes $TMP_DIR/moodle-block_task_oriented_groups/.
cp -r db $TMP_DIR/moodle-block_task_oriented_groups/.
cp -r lang $TMP_DIR/moodle-block_task_oriented_groups/.
cp -r templates $TMP_DIR/moodle-block_task_oriented_groups/.
cp -r view $TMP_DIR/moodle-block_task_oriented_groups/.
pushd $TMP_DIR >/dev/null
zip -r $PLUGIN_FILE  moodle-block_task_oriented_groups >/dev/null
popd >/dev/null
rm -rf $TMP_DIR
OLD_PLUGIN_FILE="$PLUGIN_DIR/block_task_oriented_groups_moodle35_$OLD_VERSION.zip"
if [ -f "$OLD_PLUGIN_FILE" ]; then
 rm $OLD_PLUGIN_FILE
fi

echo "Generated plugin file at: $PLUGIN_FILE"
popd >/dev/null
