# Ecommerce Template
========

# Development

To install development follow steps below:

## In windows:
1. Clone this project.
2. Add this at the end of the windows hosts file `127.0.0.1 gril-zuti.local admin.gril-zuti.local api.gril-zuti.local`
3. Execute `docker-compose up`
4. Go into the project with `winpty docker-compose exec php-fpm bash` and in the docker container:
    - Run `apt-get update`
    - Run `composer install`
    - Run `php init` and chose in which environment you want to run it
    - Run `php yii migrate`

5. Go into the project with `winpty docker-compose exec mariadb bash` and in the docker container:
    - Insert database dump with `mysql -u root -p gril_zuti_local < dump_name.sql`

6. Start developing.

