# Simple-cms

Requires:  
    - docker  
    - docker-compose

## Installation:

```
cp .env.dist .env
cd docker/dev
docker-compose up -d
docker exec -it simplecms-app composer install
docker exec -it simplecms-app php bin/console doctrine:database:create
docker exec -it simplecms-app php bin/console doctrine:schema:create
```