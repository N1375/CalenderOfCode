#!/bin/bash

UID=$(id -u)
GID=$(id -g)
export UID && export GID
docker-compose up -d --build