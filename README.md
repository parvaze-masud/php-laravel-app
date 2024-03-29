# Dockerize PHP Laravel, MySQL Application

We will need 3 different services for this setup

1. Nginx Server
2. PHP Server
3. MySQL Server

# Directory Structure
The application folder will contain all the files related to Laravel, basically the Laravel application. For this tutorial, I have just created a forum application but you can just replace it with your application code. The Nginx and PHP folders will contain the configurations related to Nginx and PHP.

![image](https://github.com/parvaze-masud/php-laravel-app/assets/141165442/8890d8a9-9b22-4ff4-8822-b223991467c5)


# Nginx Service
We will be using Nginx as the reverse proxy, the role of Nginx will be to listen on port 80 and pass the request to the PHP server so that it can process that request.
In the root folder create a file called docker-compose.yml and add the following code to it.



Create a folder called Nginx in the dockerize_laravel folder and create a file called Dockerfile in it having the following code. This file creates a docker container from nginx:alpine image and copies the Nginx configuration files from the local disk to the docker container.



Create a file called fastcgi-php.conf in the Nginx folder and the following code in it. This file defines the FastCGI config for handing PHP requests in Nginx.



Create a file called default.conf in the nginx folder and the following code in it. This file defines the Nginx configuration for the reverse proxy which listens to the request on port 80 and passes it to the PHP service which is listening on port 9000.



Now your Nginx container configuration is completed.

# PHP Service
This one is simple. Just create a folder called PHP in the dockerize_laravel folder and create a file called Dockerfile in it with the following code.

This will create a docker container from PHP fpm image (make sure to check the correct fpm version required for your Laravel version else you will end up with an error). This will also install composer and all the required PHP extensions in the container.

Now add the following code in the docker-compose.yml file


# MySQL Service
Now this one is the simplest of all. Add the following code in the docker-compose.yml file and your MySQL service is done.


# Final docker-compose.yml
This final docker-compose.yml will look something like this

Modify the MySQL configuration in the .env file as follows.

Now run the following command from the dockerize_laravel folder to start all the 3 services

`docker-compose up --build`

Now open up a new terminal tab and cd into the dockerize_laravel folder from there run the following commands to do a composer install in the container

`docker exec -it "your app container" /bin/bash`

`cd /var/www/html`

`chmod -R 775 /var/www/html/storage`

`chown -R www-data:www-data /var/www/html/storage`

`composer update --optimize-autoloader --no-dev`

`php artisan key:gen`

Right now no database is present in the MySQL container so you might face some errors because of it. To resolve that you can run the following commands to create the database and run the migrations.

In a new terminal window go to the dockerize_laravel folder and run the following commands

`docker exec -it "your DB container" /bin/bash`

`mysql -uroot -p`

Now your database named forum as mentioned in the .env file is created and ready to be used.

`create database forum;`

Now go to your app container and run

`docker exec -it "your app container" /bin/bash`

`cd /var/www/html`

`php artisan migrate`

You can now connect to the php container and run the migrations

Finally, application deployed.

![image](https://github.com/parvaze-masud/php-laravel-app/assets/141165442/99dcdae1-a74f-4a49-a436-a1d837d49ca7)

![image](https://github.com/parvaze-masud/php-laravel-app/assets/141165442/5c62f630-8172-4546-bf5a-7488b54c7190)
