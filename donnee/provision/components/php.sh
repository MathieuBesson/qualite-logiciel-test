#!/bin/bash

sudo apt-get install software-properties-common
sudo apt-get update
sudo apt-get install -y php7.4 php7.4-bcmath php7.4-bz2 php7.4-cli php7.4-curl php7.4-intl php7.4-json php7.4-mbstring php7.4-opcache php7.4-soap php7.4-xml php7.4-xsl php7.4-zip libapache2-mod-php7.4 php7.4-mysql composer apt install php7.4-pgsql

sed -i 's/max_execution_time = .*/max_execution_time = 60/' /etc/php/7.4/fpm/php.ini
sed -i 's/post_max_size = .*/post_max_size = 64M/' /etc/php/7.4/fpm/php.ini
sed -i 's/upload_max_filesize = .*/upload_max_filesize = 1G/' /etc/php/7.4/fpm/php.ini
sed -i 's/memory_limit = .*/memory_limit = 512M/' /etc/php/7.4/fpm/php.ini

sudo service nginx restart
