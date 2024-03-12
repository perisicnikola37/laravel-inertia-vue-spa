FROM php:8.2-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json composer.lock ./

RUN composer install --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload

RUN apt-get update && apt-get install -y \
    nodejs \
    npm

RUN npm install 

RUN php artisan config:clear

EXPOSE 9000

CMD php artisan serve --host=0.0.0.0 --port=9000 

