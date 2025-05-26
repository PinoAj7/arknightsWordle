FROM php:8.2-cli

# Instala dependencias
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia archivos del proyecto
WORKDIR /var/www/html
COPY . .

# Instala dependencias de Laravel
RUN composer install

# Permisos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache