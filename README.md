# Imperial Fleet inventory API

## Setup instructions

#### Run application
```
docker-compose up -d
```

#### Stop application
```
docker-compose down
```

#### Install backed dependencies
```
composer install
```

#### Compile front end
```
rm -rf node_modules && yarn install --frozen-lockfile && yarn run production
```

#### Populate the project with some data
```
docker-compose exec fleet_app php artisan migrate --seed
```

## API endpoints
#### Index
```
http GET http://fleet.local/api/spaceships
```

#### Get
```
http GET http://fleet.local/api/spaceships/ID
```

#### Create
```
http POST http://fleet.local/api/spaceships [data]
```

#### Update
```
http PUT http://fleet.local/api/spaceships/ID [data]
```

#### Delete
```
http DELETE http://fleet.local/api/spaceships/ID
```

## Tests

#### Execute tests
```
docker-compose exec fleet_app php artisan test
```
