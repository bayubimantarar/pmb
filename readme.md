# PMB STMIK Bandung
Salah satu aplikasi dari TA STMIK Bandung, PMB STMIK Bandung.

## Instalasi
1. clone repository
2. install dependencies composer

        composer install --no-dev #for production

        composer install #for development

3. copy file environment

        cp .env.example .env

4. generate application key

        php artisan key:generate

## Test
Test with phpunit

    ./vendor/bin/phpunit
