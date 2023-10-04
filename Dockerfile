FROM php:7.4-apache

# Instala las extensiones de PHP y habilita Apache mod_rewrite
RUN docker-php-ext-install pdo pdo_mysql && a2enmod rewrite

# Copia el código fuente al contenedor
COPY . /var/www/html/

# Establece los permisos adecuados
RUN chown -R www-data:www-data /var/www/html/
