
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
mysql -uroot -ppassword -e "CREATE DATABASE tecnoticos;
use tecnoticos;
CREATE TABLE dilema (
  id_dilema int AUTO_INCREMENT,
  titulo_dilema varchar(250) NOT NULL,
  resumen_dilema varchar(600) NOT NULL,
  descripcion_dilema varchar(600) NOT NULL,
PRIMARY KEY (id_dilema)
);

CREATE TABLE recurso (
id_recurso int AUTO_INCREMENT,
txt_recurso varchar(600) NOT NULL,
id_dilema int NOT NULL,
PRIMARY KEY (id_recurso),
FOREIGN KEY(id_dilema) REFERENCES dilema(id_dilema)
);


CREATE TABLE pregunta (
  id_pregunta int AUTO_INCREMENT,
  texto_pregunta varchar(250) NOT NULL,
id_dilema int NOT NULL,
PRIMARY KEY (id_pregunta),
FOREIGN KEY(id_dilema) REFERENCES dilema(id_dilema)
);

CREATE TABLE usuario (
  id_usuario int AUTO_INCREMENT,
  edad int(3) NOT NULL,
  correo varchar(250) NOT NULL,
  contraseña varchar(250) NOT NULL,
  sexo varchar(1) NOT NULL,
  rol varchar(20) NOT NULL,
PRIMARY KEY (id_usuario)
);

CREATE TABLE instituto (
id_instituto int AUTO_INCREMENT,
nombre_instituto varchar(250) NOT NULL,
dominio_instituto varchar(250) NOT NULL,
id_usuario int NOT NULL,
PRIMARY KEY (id_instituto),
FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

CREATE TABLE respuesta (
 id_respuesta int AUTO_INCREMENT,
texto_respuesta varchar(600) NOT NULL,
   id_usuario int NOT NULL,
  id_pregunta int NOT NULL,
id_dilema INT NOT NULL,
PRIMARY KEY (id_respuesta),
FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
FOREIGN KEY (id_pregunta) REFERENCES pregunta(id_pregunta),
FOREIGN KEY (id_dilema) REFERENCES dilema(id_dilema)
);

INSERT INTO usuario (edad, correo, contraseña, sexo, rol) VALUES ('33', 'admin@admin.com', 'admin', 'M', 'admin');
INSERT INTO usuario (edad, correo, contraseña, sexo, rol) VALUES ('18', 'usuario@usuario.com', 'usuario', 'H', 'usuario');
"

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
