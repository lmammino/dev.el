echo "";
echo "Preparing sources";
echo "-----------------";
gpg --keyserver  hkp://keys.gnupg.net --recv-keys 1C4CBDCDCD2EFD2A
gpg --armor --export 1C4CBDCDCD2EFD2A > key.temp;
apt-key add key.temp;
rm key.temp;
echo "deb http://repo.percona.com/apt quantal main" > /etc/apt/sources.list.d/percona.list;
echo "deb-src http://repo.percona.com/apt quantal main" >> /etc/apt/sources.list.d/percona.list;
echo "Package: *" > /etc/apt/preferences.d/00percona.pref;
echo "Pin: release o=Percona Development Team" >> /etc/apt/preferences.d/00percona.pref;
echo "Pin-Priority: 1001" >> /etc/apt/preferences.d/00percona.pref;

echo "";
echo "Update & Upgrade ";
echo "-----------------";
apt-get -y update;
apt-get -y upgrade;
apt-get -y install python-software-properties;

echo "";
echo "Installing software";
echo "-------------------";
apt-get -y install curl git nginx php5-cli php5-cgi psmisc spawn-fcgi php-pear php5-dev php-apc php5-curl php5-mcrypt php5-gd php5-intl php5-dev;

echo "";
echo "Configuring PHP";
echo "---------------";
sudo cp /vagrant/conf/php/cgi/php.ini /etc/php5/cgi/php.ini;
sudo cp /vagrant/conf/php/cli/php.ini /etc/php5/cli/php.ini;

echo "";
echo "Installing Php Tools (Composer, Boris, PHPUnit, ...)";
echo "----------------------------------------------------";
curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/bin;
cd /usr/local && git clone git://github.com/d11wtq/boris.git boris;
ln -s /usr/local/boris/bin/boris /bin;
pear config-set auto_discover 1;
pear install pear.phpunit.de/PHPUnit;
pear install phpunit/DbUnit;
pear install phpunit/PHPUnit_Selenium;
pear install phpunit/PHPUnit_Story;
pear install phpunit/PHPUnit_TestListener_DBUS;
pear install phpunit/PHPUnit_TestListener_XHProf;
pear install phpunit/PHP_Invoker;

echo "";
echo "5. Installing MySql (percona)";
echo "------------------------------";
echo "(Output hidden, please wait...)";
apt-get install -qqy debconf-utils;
echo 'percona-server-server-5.5 percona-server-server/root_password password root' | debconf-set-selections; #PERCONA MYSQL
echo 'percona-server-server-5.5 percona-server-server/root_password_again password root' | debconf-set-selections; #PERCONA MYSQL
echo 'phpmyadmin phpmyadmin/dbconfig-install boolean true' | debconf-set-selections;
echo 'phpmyadmin phpmyadmin/dbconfig-reinstall boolean true' | debconf-set-selections;
echo 'phpmyadmin phpmyadmin/app-password-confirm password root' | debconf-set-selections;
echo 'phpmyadmin phpmyadmin/mysql/admin-pass password root' | debconf-set-selections;
echo 'phpmyadmin phpmyadmin/mysql/app-pass password root' | debconf-set-selections;
echo 'phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2' | debconf-set-selections;
apt-get -y --force-yes install percona-server-server-5.5 percona-server-client-5.5 php5-mysql phpmyadmin; #PERCONA MYSQL

echo "";
echo "Configuring NGINX";
echo "-----------------";
sed -i 's/www-data/vagrant/g' /etc/nginx/nginx.conf; #runs nxginx as vagrant instead that www-data
mkdir /var/log/sites;
mkdir /var/log/sites/phpmyadmin;
mkdir /var/log/sites/projects;
ln -s /vagrant/conf/nginx/sites-available/phpmyadmin /etc/nginx/sites-enabled/phpmyadmin;
ln -s /vagrant/conf/nginx/sites-available/projects /etc/nginx/sites-enabled/projects;
unlink /etc/nginx/sites-enabled/default;
/etc/init.d/nginx restart;

echo "";
echo "Configuring PHP Fast CGI";
echo "------------------------";
cp /vagrant/conf/fcgi/init.d/php-fastcgi /etc/init.d/php-fastcgi;
chmod +x /etc/init.d/php-fastcgi;
cp /vagrant/conf/fcgi/bin/php-fastcgi /usr/bin/php-fastcgi;
chmod +x /usr/bin/php-fastcgi;
update-rc.d php-fastcgi defaults;
/etc/init.d/php-fastcgi start;

echo "";
echo "*** Ok, Man! YOU'RE READY TO GO! ***";
echo "(Press CTRL+C twice if you haven't got your shell back)";
exit 0;