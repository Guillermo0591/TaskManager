# Task Manager Test



## Installation and configuration
requirements
- Docker
- Docker compose
```
docker-compose up -d
```

Run migrations and seed and npm

```
docker-compose exec app php artisan migrate
```
```
docker-compose exec app npm install && npm run dev
```
```
docker-compose exec app php artisan db:seed
```

## Access to site
- email: admin@admin.com
- pass: admin1234

## Inside the seed for dump data to standar user
