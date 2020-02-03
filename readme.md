## BlogApi
Test task 

## Installation

1. clone repo
2. run docker containers
3. open docker workspace container 
4. composer install
6. cp .env.example .env
5. php artisan key:generate
6. php artisan migrate:fresh --seed
7. php artisan passport:install

Installation commands shorthand:
```
docker exec -it blogapi_app bash \
composer install && \
cp .env.example .env \
php artisan key:generate && \
php artisan migrate:fresh --seed && \
php artisan passport:install
```

---

## Updating app
1. pull from git
2. composer update => if issue - composer dump-autoload
3. php artisan migrate:fresh --seed
4. php artisan passport:install


## Docker commands

####Open workspace container

docker exec -it blogapi_app bash 

## PHPUnit - Unit tests / feature tests

1. Create database called testing
2. Run commands:
    - php artisan migrate --env=testing
3. Tests runs by command:
    - phpunit
    
---
    
## PHPUnit - Integration tests

1. Create database called testing
2. run commands:
    - php artisan migrate:fresh --seed --env=testing_integration
3. Tests runs by command:
    - phpunit -c phpunit-integration.xml
    
---

## PHPUnit Code Coverage

```
phpunit --coverage-html ./public/coverage -c phpunit-integration.xml
```

---
    
## Verify after pull

1. check lines count between .env and .env.example
2. run comands:
    - composer install
    - php artisan migrate:fresh --seed
    - php artisan passport:install
    - phpunit

---

## Pull requests

If we are not sure about our changes, and wish to discuss them before we push them to branch, we have the option to add a pull requst.
Creating a pull request is adding our changes to the queue of changes waiting for accept, without making them directly in branch. This allows other team members to review changed files, check our comment, and even add comments to the our lines of code. Accepting a pull request is connected with introducing changes to the branch, and running pipelines configured with the given branch.
