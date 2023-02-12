# SHAREE SALES

## Installation

Install the dependencies.

```sh
composer install
```

## Database configuration

First copy the **.env.example** to **.env** and then set **DB_DATABASE=__Your database name__** and then run the migration with seeder
```sh
php artisan migrate:fresh --seed
```
__**Note:** This will remove the existing data__

## File storage

Link the storage path to public so that uploaded files are accessible
```sh
php artisan storage:link
```

## Start the server
Now run this command to start the server
```sh
php artisan serve
```

**Enjoy!**