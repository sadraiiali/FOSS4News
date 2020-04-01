#!/usr/bin/bash
CONF=src/.env
if test -f "$CONF"; then
    echo "=> $CONF Found."
else
    echo "=> $CONF Does not exist."
    cp src/.env.example src/.env
    echo "==> I copied .env file for you just edit it :) bye"
    exit
fi

echo "=> docker-compose up -d --build"
docker-compose up -d --build

echo "=> docker-compose run --rm composer install"
docker-compose run --rm composer install

echo "docker-compose run --rm artisan key:generate"
docker-compose run --rm artisan key:generate

echo "docker-compose run --rm npm install"
docker-compose run --rm npm install

echo "=> docker-compose run --rm npm run dev"
docker-compose run --rm npm run dev

echo "=> docker-compose run --rm artisan migrate"
docker-compose run --rm artisan migrate:fresh --seed

echo "=> docker-compose run --rm artisan storage:link"
docker-compose run --rm artisan storage:link

echo "\n\n\n\n\n\n======> done :) enjoy!"