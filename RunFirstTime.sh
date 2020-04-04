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

echo "=> Generating MySQL Passwords"
sed -i "s/\(MYSQL_PASSWORD: \).*/\1$(openssl rand -base64 12)/g" ./docker-compose.yml
sed -i "s/\(MYSQL_ROOT_PASSWORD: \).*/\1$(openssl rand -base64 12)/g" ./docker-compose.yml

echo "=> npm install"
docker run -it \
	--mount type=bind,source=`pwd`/src,target=/src \
	-w /src \
	node \
	npm install

echo "=> npm run dev"
docker run -it \
        --mount type=bind,source=`pwd`/src,target=/src \
        -w /src \
        node \
        npm run dev

echo "=> composer install"
docker run -it \
        --mount type=bind,source=`pwd`/src,target=/src \
        -w /src \
        composer \
        composer install

echo "=> docker-compose up"
docker-compose up -d --build

echo "=> generate app key"
docker-compose exec app php artisan key:generate

echo "WAIT until mysql is up ..."
#TODO change to mysql checker
sleep 20

echo "=> seed DB"
docker-compose exec app php artisan migrate --seed

echo "\n\n\n\n\n\n======> done :) enjoy!"
