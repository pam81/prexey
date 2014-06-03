prexey
======

system

Instalar
1 - crear la base
2 - configurar app/config/parameters.yml
3 - php app/console doctrine:schema:update --force  => crear las tablas de la base
4 - php app/console doctrine:fixtures:load  => cargar data por default 
5 - php composer.phar install ( instalar los vendors )


