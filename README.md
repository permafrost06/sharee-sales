# SHAREE SALES

## Installation
__Assuming you have already docker installed in unix system or wsl__

**Note: Follow these steps with docker service running!**

First install the required dependencies
```sh
composer install
```

```
Then copy the **.env.example** file to **.env** and configure this file according to your need
```

And then run this command to build and start the docker container
```sh
./vendor/bin/sail up
```

After the process is finished,

__Usually this is displayed in the terminal when **./vendor/bin/sail up** is finished.__ 
> Server running on [http://0.0.0.0:80]

Run this in a new terminal
```sh
./vendor/bin/sail artisan migrate:fresh --seed
```

Then run this to make the storage accessible
```sh
./vendor/bin/sail artisan storage:link
```

Then go to http://localhost in your browser


## Making the life a bit easier
If you don't want to run __./vendor/bin/sail__ everytime you need to do something, run this:
```sh
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

Now you can replace __./vendor/bin/sail__ with __sail__

The previous commands become
```sh
sail up
sail migrate:fresh --seed
```

For more information on sail please visit https://laravel.com/docs/9.x/sail