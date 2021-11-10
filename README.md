## Human hunters test assigment

### Used technologies:
- PHP ^8
- Laravel
- MySQL

### Install

Clone project
```shell
git clone https://github.com/kriptogenic/person-hunters-test.git
```

Install dependencies
```shell
composer install
```

Copy .env.example to .env
```shell
cp .env.example .env
```

Than put mysql credentials to .env config file
```
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root_password
```

Generate application key
```shell
php artisan key:generate
```

Run migration and seed command
```shell
php artisan migrate --seed
```

Run application
```shell
php artisan serve
```


### Routes

Get posts by category_id
```
/api/posts?category_id=5
```

Get all categories as tree structure
```
/api/categories
```
