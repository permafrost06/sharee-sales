# SHAREE SALES

## Installation

First install the required dependencies
```sh
composer install
```

Then copy the **.env.example** file to **.env**
```sh
cp .env.example .env
```

And then run this command to generate the application key
```sh
php artisan key:generate
```

## Database setup
Create a mysql database using phpMyAdmin or mysql-cli then set these values in your .env file
>DB_DATABASE=&lt;your database name&gt;

>DB_USERNAME=root

>DB_PASSWORD=

__Note: Replace ```<your database name>``` with the database you created__

Also change the ```DB_USERNAME``` and ```DB_PASSWORD``` values if you have set up different username & password

## Migration

Run this command to create the tables and seed the testing data
```sh
php artisan migrate:fresh --seed
```

Then run this to make the storage accessible
```sh
php artisan storage:link
```

## Development Server

Now run this command to start the development server
```sh
php artisan serve
```

Then go to http://localhost:8000 in your browser
