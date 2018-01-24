#!/bin/bash

echo "Updating Analytics..."

ssh -t bgarner@fops1ap01.unix.ctcwest.ctc "cd /var/www/portal &&
	sudo /opt/rh/rh-php70/root/usr/bin/php artisan schedule:run &&
	exit"