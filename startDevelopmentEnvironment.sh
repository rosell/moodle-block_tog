#!/bin/bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
pushd $DIR >/dev/null
docker-compose -p moodle_block_tog_services_dev -f docker/dev/docker-compose.yml up --remove-orphans -d
DOCKER_BUILDKIT=1 docker build -f docker/dev/Dockerfile -t moodle_block_tog:dev .
if [ $? -eq 0 ]; then
    echo "Start up moodle ...  ( Attention: The first time requires some minutes)."
    docker cp docker/dev/installMoodlePlugins.sh moodle_block_tog_moodle:/.
    docker exec -it moodle_block_tog_moodle chmod +x /installMoodlePlugins.sh
    docker exec -it moodle_block_tog_moodle /installMoodlePlugins.sh
    docker run --name moodle_block_tog_dev -v /var/run/docker.sock:/var/run/docker.sock -v ${HOME}/.cache/pip:/root/.cache/pip -v ${PWD}:/app -it moodle_block_tog:dev /bin/bash
fi
popd >/dev/null