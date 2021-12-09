# backend-challenge

### 1. Rename .env.example to .env

### 2. Run Docker

#### Start the docker enviroment
```
docker-compose up -d
```

#### Setup Laravel project

```
docker exec app composer install
docker exec app php artisan key:generate
docker exec app php artisan optimize
docker exec app php artisan migrate

```
#### Enter the Container
```
docker exec -it CONTAINER_ID bash 
```

#### Use

The API will be available at `localhost:8100` and the database at `localhost:33062`

#### Documentation

Documentation is available at:

```
    localhost:8100/api/doc
```
