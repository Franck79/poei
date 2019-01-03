#!/bin/bash
drush sset system.maintenance_node 1
echo Maintenance mode enable.
drush cr
git pull origin master
echo Pull Master done.
composer install --no-dev
echo Installation/Update Drupal Core.
drush cr
drush updb
echo Update modules.
drush cr
drush csex prod -y
echo Exports config Prod.
drush cim -y
echo Import config ok.
drush cr
drush sset system.maintenance_node 0
drush cr
echo Site is online.
