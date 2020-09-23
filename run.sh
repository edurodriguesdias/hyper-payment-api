#!/bin/bash
echo Go to docker dir
cd docker

echo Uploading Application container
docker-compose up --build -d

echo Install dependencies
docker run --rm --interactive --tty -v $PWD/hyper-payment-api:/app composer install

echo Make migrations
docker exec -it php php /var/www/html/artisan migrate

echo Run seeds
docker exec -it php php /var/www/html/artisan db:seed

echo Start queue service
docker exec -it php php /var/www/html/artisan queue:work --queue=high,medium,low,default