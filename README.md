## Портал Министерства Внутренних Дел по Республике Башкортостан

````
Стек:
- Laravel 12.2,
- PostgreSQL 16.2,
- Redis (кеш)
- Oracle DB (На боевом сервере для сервисов)
````
# Запуск

````
docker compose up -d --build

docker exec -ti mvdrb-portal-php-fpm composer i

docker exec -ti mvdrb-portal-php-fpm php artisan storage:link

docker exec -ti mvdrb-portal-php-fpm php artisan migrate --seed

````
