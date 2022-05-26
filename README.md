# Test app

## to install via docker run commands
- docker-compose up -d --build
- docker-compose run --rm composer install
- docker-compose run --rm npm install
- docker-compose run --rm npm run dev
- docker-compose exec -it app3 bash
  - inside terminal run commands:
  - php artisan migrate
  - php artisan rabbitmq:consume
- open http://localhost:8080

## to run tests
- docker-compose exec -it app3 bash
  - inside terminal run commands:
  - ./vendor/bin/phpunit
