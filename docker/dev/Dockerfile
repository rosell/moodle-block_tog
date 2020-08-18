# syntax=docker/dockerfile:experimental

FROM debian:stable-slim

RUN apt-get -y update

# Install node.js
RUN --mount=type=cache,id=apt-debian-cache-amd64,target=/var/cache/apt apt-get -y install curl git tar gzip apt-transport-https ca-certificates gnupg-agent software-properties-common
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get -y update
RUN --mount=type=cache,id=apt-debian-cache-amd64,target=/var/cache/apt apt-get -y install nodejs zip

# Install sw to use docker
RUN --mount=type=cache,id=apt-debian-cache-amd64,target=/var/cache/apt apt-get -y install git tar gzip apt-transport-https ca-certificates gnupg-agent software-properties-common
RUN curl -fsSL https://download.docker.com/linux/debian/gpg | apt-key add -
RUN add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/debian $(lsb_release -cs) stable"
RUN apt-get -y update
RUN --mount=type=cache,id=apt-debian-cache-amd64,target=/var/cache/apt apt-get -y install docker-ce-cli docker-compose

# Install sw to manage php
# RUN --mount=type=cache,id=apt-debian-cache-amd64,target=/var/cache/apt apt-get -y install php-cli php-xml php-mbstring php-curl
# WORKDIR /tmp
# ADD https://phar.io/releases/phive.phar phive.phar
# ADD https://phar.io/releases/phive.phar.asc phive.phar.asc
# RUN gpg --keyserver pool.sks-keyservers.net --recv-keys 0x9D8A98B29B2D5D79
# RUN gpg --verify phive.phar.asc phive.phar
# RUN chmod +x phive.phar
# RUN mv phive.phar /usr/local/bin/phive
# RUN phive install php-cs-fixer --global

# Install wait for to wait until moodle is ready
ADD https://raw.githubusercontent.com/eficode/wait-for/master/wait-for /wait-for
RUN chmod +x /wait-for

WORKDIR /app
COPY package.json .
RUN --mount=type=cache,id=node-cache,target=node_modules npm install

CMD /wait-for host.docker.internal:80 -- bash