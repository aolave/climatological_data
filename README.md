# Weather Module to Magento 2.4.6

### Authors
- Adrian Robledo <adrian.olave@gmail.com>

### Package
AR_Weather

## AR_Weather module by Cesar Robledo 

    AR/module-weather

- [Main Functionalities](#markdown-header-main-functionalities)
- [Installation](#markdown-header-installation)
- [Specifications](#markdown-header-specifications)

## Main Functionalities
 Weather API

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/AR`
 - Enable the module by running `php bin/magento module:enable AR_Weather`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer - NOT AVAILABLE YET
```bash
composer require ar/module-weather
```

# Magento 2.4.6 Installation Guide

### Repository Public: Backup Database Repository Root: magento.sql
- Magento: Repository Root: reqm2/src
- Installation project: (para la instalación desde cero revisar: Task 1:) 
- git clone https://github.com/aolave/climatological_data
- mkdir -p ~/Sites 
- mv reqm2 ~/Sites/magento 
- cd ~/Sites/magento

### Download the Docker Compose template:
- curl -s https://raw.githubusercontent.com/markshust/docker-magento/master/lib/template | bash

### Start some containers, copy files to them and then restart the containers:
- bin/start --no-dev
- bin/copytocontainer --all ## Initial copy will take a few minutes...

### If your vendor directory was empty, populate it with:
- bin/composer install

### Import existing database:
- bin/mysql < magento.sql
- bin/restart

### bin/magento setup:upgrade
- Open site: https://reqm2.local/ 
- Open admin: https://reqm2.local/admin

### Documentation
- Docker magento: [DOCUMENTATION](https://github.com/markshust/docker-magento)

### Copyright
Copyright (c) 2023 Adrian Robledo