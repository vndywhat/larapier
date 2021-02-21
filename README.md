## About
Попытка переписать с нуля legacy код движка TorrentPier II

## Requirements
* Basic Laravel requirements
* Nginx (recommended) or Apache
* PHP 7.4 or higher
* MySQL 5.7 or higher
* Redis

## Install
* Copy .env.example to .env and setup database and redis settings
```
cd path/to/project
composer update
php artisan migrate --seed
php artisan queue:work
```

## User
* Login & password: admin
