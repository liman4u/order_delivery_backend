 **Technology**

- Lumen Framework 5.7

- Docker

- PHP 7.1.3

- Data was persisted with MySql 5.6 
    - Connection details:
        - port: `3306`
        - MYSQL_DATABASE: `order_delivery_db`
        - MYSQL_USER: `order_delivery`
        - MYSQL_PASSWORD: `order_delivery`

- Testing was done with PhpUnit 

- Used DDD (Domain-Driven Design) approach

 **Main Packages**

- This can be found in the composer.json in the root directory of the project

- PhpUnit 7.0 was used for testing , am more familiar with this than others like Codeception and Behat

- Fractal -  provides a presentation and transformation layer for complex data output

- L5 Repository - used to abstract the data layer, making our application more flexible to maintain 

 **How to run**
- Clone for Github and Copy Environment Variables
```bash
git clone git@github.com:liman4u/order_delivery_backend.git

cd order_delivery_backend

cp .env.example .env
```

- Enter a custom google map api key in the .env, to be used to get distance from Google Distance Matrix API

- To start the application server and run tests, run the following from root of application:
```bash
sh ./start.sh
```
- Tests can also be run separately by running[from the project's root folder] "composer test" when the docker container is up and running

- In case the start.sh does not seem to be runnable, use chmod 400 start.sh

 **Features**

The API  conformed to REST practices and  provide the following functionality:

- Place order
- Take order
- List order

 **Endpoints**

- The postman documentation link is at https://documenter.getpostman.com/view/3189851/RWaLvSng

- This application conform to the specified endpoint structure given and return the HTTP status codes appropriate to each operation.  


 **Environment Variables**

- These are found in .env of the root directory of the project

- For production deployments , DEBUG should be switched to 'false' and APP_ENV changed to 'production'


 **Data Migration**

- This is found in database/migrations/ in the root directory of the project


 **Routes**

- This can be found in app/Context/Api/routes.php in the root directory of the project