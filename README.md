# metadocument
Finder Google drive document and metadata filter

Genera busquedas en google Drive de una cuenta y agregar Metadatos para filtrar y buscar por las mismas


Configuring Apache using .htaccess or VirtualHost directive

In order for the routing to function you'll need to have mod_rewrite installed. You can specify the following inside of your VirtualHost directive or in a .htaccess file inside your web root.

RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)\?*$ index.php?__route__=/$1 [L,QSA]
Configuring Nginx

In order for the routing to function you'll need to have HttpRewriteModule installed. You can specify the following inside of your server configuration.

if (!-e $request_filename) {
  rewrite ^(.*) /index.php?__route__=$1 last;
}