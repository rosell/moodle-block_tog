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
CURRENT_VERSION=$(cat version.php|grep "version = "| grep -o -E '[0-9]+')
PREVIOUS_VERSION=$CURRENT_VERSION
PREVIOUS_VERSION_FILE=".previousPluginZipFileVersion"
if [ -f $PREVIOUS_VERSION_FILE ];
then
	PREVIOUS_VERSION=$(cat $PREVIOUS_VERSION_FILE)
fi
while [ $VERSION -le $PREVIOUS_VERSION ]
do
 VERSION=$((VERSION+1))
done

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

for file in *.md *.php *.css;
do
	cp $file $TMP_DIR/moodle-block_task_oriented_groups/.
done
for dir in amd classes db lang templates view;
do
	if [ -d "$dir" ]; then
		cp -r $dir $TMP_DIR/moodle-block_task_oriented_groups/.
	fi
done
pushd $TMP_DIR >/dev/null
sed -i '' -e "s/version = $CURRENT_VERSION/version = $VERSION/g" $TMP_DIR/moodle-block_task_oriented_groups/version.php
zip -r $PLUGIN_FILE  moodle-block_task_oriented_groups >/dev/null
popd >/dev/null
rm -rf $TMP_DIR
OLD_PLUGIN_FILE="$PLUGIN_DIR/block_task_oriented_groups_moodle35_$CURRENT_VERSION.zip"
if [ -f "$OLD_PLUGIN_FILE" ]; then
 rm $OLD_PLUGIN_FILE
fi
echo $VERSION > $PREVIOUS_VERSION_FILE

echo "Generated plugin file at: $PLUGIN_FILE"
popd >/dev/null
