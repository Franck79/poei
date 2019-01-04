#!/bin/bash

#Début maintenance
#drush sset system.maintenance_node 1
drush config-set readonlymode.settings enabled 1 -y
echo Maintenance mode enable.
drush cr

#Pull master origin
git pull origin master
echo Pull Master done.

#Installation
composer install --no-dev
echo Installation/Update Drupal Core.
drush cr

#Update
drush updb
echo Update modules.
drush cr

#Export config prod
drush csex prod -y
echo Exports config Prod.

#Import new config
drush cim -y
echo Import config ok.
drush cr

#Ajout des config de prod
git add config/prod
git commit -m 'Ajout des config de prod.'


#Fin maintenance
#drush sset system.maintenance_node 0
drush config-set readonlymode.settings enabled 0 -y
drush cr
echo Site is online.