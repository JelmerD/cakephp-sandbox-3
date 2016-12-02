#!/usr/bin/env bash
echo "==> [ Entering bootstrap ]"

# VARS
DATABASE_NAME="sandbox"

# ADD PHP7 PACKAGE LIST
if ! grep -q "deb http://packages.dotdeb.org jessie all" /etc/apt/sources.list; then
    echo "==> Adding PHP7.0 package list"
    echo "deb http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list
    echo "deb-src http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list
    wget https://www.dotdeb.org/dotdeb.gpg
    apt-key add dotdeb.gpg
fi

echo "==> Updating Aptitude..."
aptitude update

echo "==> Installing/updating build-essential..."
sudo aptitude install -y build-essential

# DOS2UNIX
if [ ! -f /usr/bin/dos2unix ]; then
    echo "==> Installing dos2unix..."
    aptitude install -y dos2unix
fi

# GIT
if [ ! -f /usr/bin/git ]; then
    echo "==> Installing GIT..."
    aptitude install -y git
fi

# APACHE
if [ ! -d /etc/apache2 ]; then
    echo "==> Installing Apache2..."
    aptitude install -y apache2
    a2enmod rewrite

    # Configure Apache
    echo "<VirtualHost *:80>
        DocumentRoot /var/www/webroot
        AllowEncodedSlashes On
        <Directory /var/www/webroot>
            Options +Indexes +FollowSymLinks
            DirectoryIndex index.php index.html
            Order allow,deny
            Allow from all
            AllowOverride All
        </Directory>
        ErrorLog ${APACHE_LOG_DIR}/vagrant_error.log
        CustomLog ${APACHE_LOG_DIR}/vagrant_access.log combined
    </VirtualHost>" > /etc/apache2/sites-available/000-default.conf
fi

# MYSQL
if [ ! -f /usr/bin/mysql ]; then
    echo "==> Installing MySQL..."
    echo "mysql-server mysql-server/root_password password root" | debconf-set-selections
    echo "mysql-server mysql-server/root_password_again password root" | debconf-set-selections
    aptitude install -y mysql-client mysql-server
fi

echo "==> Creating databases..."
echo "CREATE DATABASE IF NOT EXISTS ${DATABASE_NAME} DEFAULT CHARACTER SET utf8" | mysql -uroot -proot
echo "CREATE DATABASE IF NOT EXISTS debug_kit DEFAULT CHARACTER SET utf8" | mysql -uroot -proot
echo "CREATE DATABASE IF NOT EXISTS test DEFAULT CHARACTER SET utf8" | mysql -uroot -proot
echo "GRANT ALL ON *.* TO 'root'@'localhost'" | mysql -uroot -proot
echo "flush privileges" | mysql -uroot -proot

# CURL
if [ ! -f /usr/bin/curl ]; then
    echo "==> Installing CURL..."
    aptitude install -y curl
fi

# PHP
if [ ! -f /usr/bin/php ]; then
    echo "==> Installing PHP..."
    # required by CakePHP
    aptitude install -y php7.0 php7.0-mbstring php7.0-intl php7.0-mysql
    # these are not...
    aptitude install -y php7.0-cli php7.0-curl php7.0-pear php7.0-mcrypt php7.0-json libapache2-mod-php7.0 php7.0-xdebug php7.0-zip
fi

# COMPOSER
if [ -e /usr/local/bin/composer ]; then
    /usr/local/bin/composer self-update
else
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi

# Reset home directory of vagrant user
if ! grep -q "cd /var/www" /home/vagrant/.profile; then
    echo "cd /var/www" >> /home/vagrant/.profile
fi

# RESTART
service apache2 restart
service mysql restart