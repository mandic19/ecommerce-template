Ecommerce template app
============================

### Description

This is a dockerized e-commerce sample project that introduces all the main concepts of a modern e-commerce application.
The purpose is to create a customizable and extensible template and save me a lot of time on repetitive work.

###Technologies used:

    ├── FRONTEND                             # Angular 14
    ├── ADMIN PANEL                          # Yii2 PHP Framework
    ├── RESTFUL API                          # Yii2 PHP Framework
    ├── WEBSERVER                            # Nginx

### Directory structure

    ├── api                                  # Yii2 RESTFUL API application
    ├── backend                              # Yii2 ADMIN PANEL application
    ├── frontend                             # Angular 14 FRONTEND application
    ├── console                              # Yii2 CONSOLE application
    ├── common                               # Contains shared portion between api, backend and console application
    ├── environments                         # Contains environment-based overrides
    ├── vendor                               # Contains dependent 3rd-party packages
    ├── docker                               # Docker configuration
    │   ├── nginx                   
    │   │   ├── dev              
    │   │   │   ├── default.config           # nginx default configuration for dev/local environment
    │   │   ├── prod              
    │   │   │   ├── default.config           # nginx default configuration for production environment
    │   ├── php-fpm
    │   │   │   ├── Dockerfile               # php-fpm container build instructions
    │   │   │   ├── pho-ini-overrides.ini    # Config for overriding php.ini settings
    │   ├── docker-database.env              # Development environment db variables
    │   ├── docker-database-prod.env         # Production environment db variables
    ├── logs                                 # NGINX access/error logs
    ├── Dockerfile.prod                      # NGINX container build instructions for production environment
    ├── docker-compose.yml                   # compose boilerplate file for development environment
    ├── docker-compose-prod.yml              # compose boilerplate file for production environment
    ├── composer.json
    ├── composer.lock
    └── README.md

### Development

In a project root:

1. Run command: `docker-compose up --build`
2. Run command: `winpty docker-compose exec api bash` and in the docker container:
   - Navigate to `application/api` subdirectory
   - Run `apt-get update`
   - Run `composer install`
   - Run `php init` and chose in which environment you want to run it
   - Run `php yii migrate`

### Production

In a project root:

1. Run command: `docker-compose -f docker-compose-prod.yml up --build`
2. Run command: `winpty docker-compose exec api bash` and in the docker container:
   - Navigate to `application/api` subdirectory
   - Run `apt-get update`
   - Run `composer install`
   - Run `php init` and chose in which environment you want to run it
   - Run `php yii migrate`
