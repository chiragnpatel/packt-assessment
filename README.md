<p align="center"><a href="https://www.packtpub.com/" target="_blank"><img src="https://www.packtpub.com/images/logo-new.svg" width="400"></a></p>

## Packt Assessment

This the assessment project for packt only developed by Chirag Patel.

## System Requirements
    - Composer 
    - PHP 8.0 >
    - Laravel 8.0 >
    - MySql / MariaDB
    - node.js & npm
## Installation
```python
   1) Clone repo
   2) run `php artisan key:generate`
   3) Creat .env file from .env.example
   4) Change DB connections varibale
   5) Add 'PACKT_TOKEN' & 'END_POINT' in .env file.
        #you will get END_POINT and PACKT_TOKEN from [https://api.packt.com/].
   6) run `php artisan migrate`
   7) run `php artisan db:seed --class=CategoriesTableSeeder` to insert categories.
   8) run `php artisan product:sync-products` to sync Product master data.
   9) run `php artisan product:sync-products child` to sync Product detail data.
   
   # Install Breeze and dependencies...
     composer require laravel/breeze --dev
     
     php artisan breeze:install api
     
     composer dump-autoload -o
       
```
Next, ensure that your application's APP_URL and FRONTEND_URL environment variables are set to http://localhost:8000 and http://localhost:3000, respectively.

After defining the appropriate environment variables, you may serve the Laravel application using the serve Artisan command:
```python
    # Serve the application... "laravel project folder"
    php artisan serve
```

Next, go to ```cd frontend & run npm install```.Then, copy the .env.example file to .env.local and supply the URL of your backend:
```
NEXT_PUBLIC_BACKEND_URL=http://localhost:8000
```
Finally, run the application via ```npm run dev```. The application will be available at ```http://localhost:3000```:

## Chirag Patel
[codementor](https://codementor.tech)
