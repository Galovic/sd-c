## CMS 4G/SIMPLO

Finally! We have new CMS built with Laravel 5.3! :stuck_out_tongue_winking_eye:

Requirements:
* PHP >= 5.6.4
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* Fileinfo PHP Extension
* DB
* mod_rewrite


## Installation

##### Composer

> [Download Composer](https://getcomposer.org/download/)

```
composer install
```



##### Node.js

> [Download Node.js](https://nodejs.org/en/)

> [Install Gulp](http://laravel.com/docs/5.3/elixir#installation)

```
npm install --global gulp-cli

# On windows:
npm install --no-bin-links

# Then install SASS
npm install node-sass
```


##### Environment settings

```
copy .env.example .env
php artisan key:generate
```

> *Don't forget to configure your .env file!*



##### Migrate DB

```
php artisan migrate --seed
```



##### Compile your assets

```
gulp
gulp fonts
```

## Commands

#### Clear all cache

Clears all cache including routes, views etc. 

```
php artisan clearcache
```

## Konfigurace

Popis nastavení v konfiguračních souborech.

### Konfigurace projektu - project.php
#### project.functionality
Pomocí nich lze zakázat / povolit a nastavit jednotlivé funcionality dostupné v administraci.

##### Tagování článků

article_tags - Hodnota ```true``` umožní tagování článků.