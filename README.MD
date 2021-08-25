# Yaraku Coding Challenge
The following  is an assignment fora job applicaion in Yaraku. This project is a Book CRUD with sorting, search and CSV/XML export. It includes the following frameworks.
- Laravel 8
- InertiaJS 0.9.2
- VueJS 2
- Bootstrap-Vue 2

## How to run in local
You need the following installed
- Apache Server
- PHP 7.4
- MySQL / MariaDB (although PostgreSQL could work too)
- Composer 2
- NodeJS v14

Note: In Windows you can use XAMPP or it's equivalent in other O.S.

This repository provides a Dockerfile, a docker-compose.yml and a dev .env file to run a development enviroment for the project. For that you will need
- A machine capable to run Docker
- Docker Engine and Docker Compose already installed. In Windows and Mac both are provided with Docker Desktop, in Linux please follow the official Docker documentation for their installation. To check if you have both docker engine and docker compose installed, run in terminal
`docker -v` and `docker-compose -v`

### Run the project into your local setup
1. Clone this repository with `git clone https://github.com/PPastene/Yaraku-Challenge`, and copy the /src folder into the root of your webserver (in Apache is the www/ folder)
2. Create a database and assign an username and a password
3. Copy the .env.example and rename it to .env, then open it with a text editor and write the database info
- DB_HOST: The url of the database
- DB_PORT: The port of the database
- DB_DATABASE: The name of the database
- DB_USERNAME: The username created for the database
- DB_PASSWORD: The password created for the user
4. Run `composer install` to install the PHP packages
5. Run `php artisan migrate`. If returns a successful message then the connection with the database has been successful. If returns an error please check the database or the variables in the .env
6. Run `php artisan key:generate` to generate an Application Key for the system
7. In your application folder, run `npm i` to install the NodeJS packages.
8. Run `npm run dev` to compile the frontend files. If it's run for a first time Laravel-Mix will download some packages and install them, then it will ask you to run `npm run dev` to continue with the compilation
9. Enter to http://localhost/ to check the website

### Run the project with Docker
1. Clone this repository with `git clone https://github.com/PPastene/Yaraku-Challenge`
2. Run `docker-compose --env-file dev/.docker.dev.env up -d` and wait until completition (Note: Make sure there's not other containers or services that are using the 80 and 3306 ports. If so, you can change the ports in the .env files and the docker-compose file before executing the up command)
3. Run `docker exec -it Yaraku_Challenge-laravel-local bash` to enter the container
4. Inside the container, run `composer install` to install the PHP packages
5. Inside the container, run `php artisan migrate`. If returns a successful message then the connection with the database has been successful. If returns an error please check if the database container has been started up (check with `docker ps`)
6. Exit the container with `exit`, then run `docker-compose run --rm npm i` to install the NodeJs packages
7. Run `docker-compose run --rm npm run dev` to compile the frontend files. If it's run for a first time Laravel-Mix will download some packages and install them, then it will ask you to run `docker-compose run --rm npm run dev` to continue with the compilation
8. Enter to http://localhost/ to check the website
9. You can stop the containers with `docker-compose --env-file dev/.docker.dev.env down -v`
Note: If you have NodeJS installed locally you can skip using the container and run the `npm i` and `npm run dev` commands directly into the src/ folder

## How to test the application
The project provides some tests to check the if the routes are providing the required data and doing the required actions.

- If you installed the application into your local setup, in your .env change the `APP_ENV` variable to `testing`, then open a terminal and run `php artisan test`. The recommendation is to create another database for testing and not compromise the data already saved in development.
- As well for the development, this project  provides a testing .env file. To run the testing environment run `docker-compose --env-file test/.docker.test.env up -d` and follow the same instructions, once the website is running execute `docker exec -it Yaraku_Challenge-laravel-testing bash` and run `php artisan test` for testing. Don't forget to run  `docker-compose --env-file test/.docker.test.env down -v` to stop the containers.
