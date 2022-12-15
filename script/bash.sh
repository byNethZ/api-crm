#!/bin/sh
cd /home/u501033011/domains/bliones.net/api-rest-bliones && /opt/alt/php81/usr/bin/php artisan schedule:run >> /dev/null 2>&1
