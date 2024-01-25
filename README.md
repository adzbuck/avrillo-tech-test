### Task

- The challenge will contain a few core features most applications have. That includes connecting to an API, basic MVC using Laravel, exposing an API, and finally, tests.
- The API we want you to connect to is https://kanye.rest/
- The application should have the following features
- A rest API that shows 5 random Kayne West quotes (must)
- There should be an endpoint to refresh the quotes and fetch the next 5 random quotes (must)
- Authentication for these APIs should be done with an API token, not using any package. (must)
- The above features are tested with Feature tests (must)
- The above features are tested with Unit tests (nice to have)
- Provide a README on how we can set up and test the application (must)
- Implementation of API using Laravel Manager Design Pattern (Plus)
- Making third-party API response quick by cache(Plus)

### Getting started
This project uses laravel sail.

#### Copy the .env.example
`cp .env.example .env`

#### Install composer dependencies
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

#### Update app key
`artisan key:generate`

#### Update service ports
In case you have services running on the default HTTP, MySQL or Redis ports you can update them in the .env file.

To change the HTTP port add `APP_PORT=8080` into the .env file

To change the MySQL port add `FORWARD_DB_PORT=3308` into the .env file

To change the Redis port add `FORWARD_REDIS_PORT=6380` into the .env file

#### Start sail
`./vendor/bin/sail up`

#### Create and seed the database
`./vendor/bin/sail artisan migrate:fresh --seed`

#### Get a token for a user
The default seeder creates 10 users with tokens(ids from 1-10), to get a token run
Replace `{userId}` with the id of the user.
`./vendor/bin/sail artisan app:get-auth-token {userId}`

#### Generate API docs
`./vendor/bin/sail artisan l5-swagger:generate`

#### Visit api docs
Once the docs have been created, visit them by visiting:
Replace {port} with the APP_PORT value in `.env`
`http://localhost:{port}/api/documentation#/default`

If you haven't used swagger docs before, click on the "Authorize" button ad add the token in the modal.
