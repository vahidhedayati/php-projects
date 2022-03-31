To get wordpress working under ubuntu:

mysql is known as  mariadb in later revisions of ubuntu
 
`sudo apt-get install php php-gd php-mysql php-cli php-common mysql-server mysql-common `


Download wordpress:
`https://en-gb.wordpress.org/download/#download-install`


extract it
`tar -xvzf ~/Downloads/wordpress-5.9.2-en_GB.tar.gz `


install visual studio code

cd wordpress
code . 

rename `wp-config-example.php` to `wp-config.php`

Configure DB Section:
```
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress' );
```


Create relevant DB and set up mysql permissions by running:

```
sudo mysqladmin create  wordpress

sudo mysql -u root

CREATE USER 'wordpress'@'localhost' IDENTIFIED BY 'wordpress';
GRANT ALL PRIVILEGES ON wordpress. * TO 'wordpress'@'localhost';
flush privileges;
exit.

```

now start up site :

`php -S localhost:8989`


Within visual studio code create a files called `.htaccess`  in root folder where index.php is 


```

# BEGIN WordPress

RewriteEngine On
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]

# END WordPress
```


In the browser go through configuration  and setup admin username / password 


After it is all configured and you are logged in  find settings on left menu bar and navigate to Permalinks - change link style to 4th option Post name

Goto themes and add new search for install `OceanWP` and activate configure theme

Follow what it suggests install Ocean Extra after which the option to configure OceanWP appears , go through wizard and choose one scroll to bottom install, then additional installable features which suggests install install them, any suggesting get this addon is pay for 

Goto plugins search for `Elementor`  `Elementor Website Builder` install & activate 

In plugins look for `all-in-one WP migration` install and activate - this is for keeping a backup of your wordpress




Create Pages in the pages meny and using Appearance / Menus you can create / customize the menu bars to contain new pages / content as part of navigation


In plugins you can now disable OceanWP related plugins.

You can use https://www.pexels.com/ & https://unsplash.com/ FOR freely-usable images.
You can use https://logomakr.com/ and export out a low resolution logo 
