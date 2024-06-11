FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) iconv gd \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer la variable de entorno para permitir que Composer se ejecute como superusuario
ENV COMPOSER_ALLOW_SUPERUSER=1

# Crear directorio de trabajo
WORKDIR /var/www

# Copiar el proyecto actual al directorio de trabajo

# COPY . .

RUN rm -rf /var/www/*

# Instalar Laravel solo si no existe el archivo composer.json
RUN if [ ! -f "composer.json" ]; then \
        composer create-project --prefer-dist laravel/laravel .; \
    else composer install; \
    fi

# Modificar permisos para directorios necesarios
RUN chown -R www-data:www-data storage bootstrap/cache

# Exponer el puerto 9000 y ejecutar PHP FPM
EXPOSE 9000
CMD ["php-fpm"]
