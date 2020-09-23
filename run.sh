#!/bin/bash
echo Go to docker dir
cd docker

echo Uploading Application container
docker-compose up --build -d

echo Install dependencies
docker run --rm --interactive --tty -v $PWD/hyper-payment-api:/app composer install

echo Running migrations
docker exec -it php php /var/www/html/artisan migrate

echo Running seeds
docker exec -it php php /var/www/html/artisan db:seed

echo Queue working
docker exec -it php php /var/www/html/artisan queue:work --queue=high,medium,low,default