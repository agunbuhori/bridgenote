## How to install this project?

Clone the project to directory :

```
cd /your/directory
git clone https://github.com/agunbuhori/bridgenote.git
```

Then install packages by composer

```
composer install
```

Edit .env and setup database configuration
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=DB NAME
DB_USERNAME=DB USERNAME
DB_PASSWORD=DB PASSWORD
```

Migrate and seed, then install passport
```
php artisan migrate --seed
php artisan passport install
```

Test application
```
php artisan test
```



