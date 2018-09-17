#!/bin/bash

docker-compose down

composer install

docker-compose up -d --force-recreate

>&2 echo "Waiting for MySql to run. Please wait....."
sleep 10
>&2 echo "MySql started :)"
>&2 echo "Running all phpunit tests now...."

docker container exec -it order-delivery-backend-app php artisan migrate --seed
>&2 echo "Database migrations and seeders done..."


docker container exec -it order-delivery-backend-app composer test
>&2 echo "All tests done..."


>&2 echo "Order delivery backend api v1 is now ready "
sleep 10
exit 0
