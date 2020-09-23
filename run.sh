#!/bin/bash
echo Create copy .env-example to .env
cp ./.env-example ./.env

echo Uploading Application containers
docker-compose up --build -d

echo Install dependencies
docker run --rm --interactive --tty -v $PWD:/app composer install

echo Refresh migrations
docker exec -it php php /var/www/html/artisan migrate:refresh

echo Running migrations
docker exec -it php php /var/www/html/artisan migrate

echo Running seeds
docker exec -it php php /var/www/html/artisan db:seed
echo --------API SET UP FINISH--------
echo send a POST request to http://localhost/transaction and enjoy it!

echo Queue working
docker exec -it php php /var/www/html/artisan queue:work --queue=high,medium,low,default