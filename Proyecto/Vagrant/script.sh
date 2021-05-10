
apt-get update
apt-get install -y apache2 apache2-utils
a2enmod rewrite
sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/sites-available/default

#Install php
apt -y install libapache2-mod-php
a2enmod php7.2

#Install mySQL
apt-get uptade -y
debconf-set-selections <<< 'mysql-server-<version> mysql-server/root_password password password'
debconf-set-selections <<< 'mysql-server-<version> mysql-server/root_password_again password password'
apt-get install -y mariadb-server mariadb-client
systemctl enable mariadb
#apt-get install -y mysql-server

# Connect PHP and MySQL
apt install php-mysql -y
systemctl restart apache2

# Setup database
# mysql -uroot -ppassword -e "CREATE DATABASE tecnoticos;

# use tecnoticos;
#"

#Users
mysql -uroot -ppassword -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'password';"
mysql -uroot -ppassword -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' IDENTIFIED BY 'password';"
sed -i 's/^bind-address/#bind-address/' /etc/mysql/my.cnf
sed -i 's/^skip-external-locking/#skip-external-locking/' /etc/mysql/my.cnf
sudo service mysql restart

# Copiar archivos de conf
cp /vagrant/my.cnf /etc/mysql/my.cnf

# Install composer
curl -sS http://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Run composer install
cd /vagrant && composer install --dev

# Run migrations
php /vagrant/artisan migrate --seed

# Change apache document root
sed -i 's/index.html/Login.php/g' /etc/apache2/mods-available/dir.conf
sudo service apache2 restart
