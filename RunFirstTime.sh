#!/usr/bin/bash
CONF=src/.env
if test -f "$CONF"; then
    echo "=> $CONF Found."
else
    echo "=> $CONF Does not exist."
    cp src/.env.example src/.env
    echo "==> I copied .env file for you just edit it then run this code again :) bye"
    exit
fi

echo "=> Generating MySQL Passwords"
dbUserPassword=`openssl rand -base64 12 | tr -d "=+/" | cut -c1-25`
dbRootPass=`openssl rand -base64 12 | tr -d "=+/" | cut -c1-25`
sed -i "s/\(MYSQL_PASSWORD: \).*/\1$dbUserPassword/g" ./docker-compose.yml
sed -i "s/\(MYSQL_ROOT_PASSWORD: \).*/\1$dbRootPass/g" ./docker-compose.yml
sed -i "s/\(DB_PASSWORD: \).*/\1$dbUserPassword/g" ./docker-compose.yml

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

echo "=> generate foss4_app key"
docker-compose exec foss4_app php artisan key:generate

echo "=> php artisan storage:link"
docker-compose exec foss4_app php artisan storage:link

echo "WAIT until mysql is up ..."
#TODO change to mysql checker
sleep 100

echo "=> seed DB"
docker-compose exec foss4_app php artisan migrate --seed

echo "\n\n\n\n\n\n======> done :) enjoy!"
