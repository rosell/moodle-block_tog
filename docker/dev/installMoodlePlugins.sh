#!/bin/bash
until [[ -d /bitnami/moodle/local ]]
do
     sleep 5
done
pushd bitnami/moodle/local >/dev/null
if [[ ! -d "moodlecheck" || ! -d "codechecker" ]]; then
    apt-get update
    apt-get -y install git
    git clone https://github.com/moodlehq/moodle-local_moodlecheck.git moodlecheck
    git clone https://github.com/moodlehq/moodle-local_codechecker.git codechecker
    chown -R daemon:root .
fi
popd >/dev/null
