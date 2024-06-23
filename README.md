
## Getting Started
To get started with this project, follow these steps:

1. Clone the repository using the following command: git clone https://github.com/Rostislav901/test-task
2. Navigate to the master branch of the repository: git checkout master
3. Up symfony-project:  docker-compose up -d --build
4. Check containers: docker-compose ps
5. Install project dependencies using Composer: docker-compose exec php-fpm composer instal
7. Configure the `.env` file(DATABASE_URL)
8. Migrate: docker-compose exec php-fpm php bin/console doctrine:migrations:migrate

## Accessing API Documentation

You can explore the API documentation using Swagger UI. Simply navigate to the following endpoint in your browser:

- Swagger UI Endpoint: `/api/doc`

This will open up the Swagger documentation interface, where you can interactively explore and test the available endpoints and their functionalities.
