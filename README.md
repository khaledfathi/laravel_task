requirements : 

for quick run , install [XAMPP](https://www.apachefriends.org/) with php 8.2
install [Composer](https://getcomposer.org/) 2.2.6  or higher 
config and run:

```shell
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed AdminUserSeeder
php artisan storage:link
mkdir ./public/storage/message_file_uploaded
cp ./public/assets/images/default_user_image.svg ./public/storage/message_file_uploaded/
php artisan serv
```
