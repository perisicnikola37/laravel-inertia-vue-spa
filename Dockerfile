FROM php:8.2-cli

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application files
COPY . .

# Generate autoload files
RUN composer dump-autoload

# Install npm packages and build
RUN npm install && npm run build

# Expose ports for both PHP and npm servers
EXPOSE 9000
EXPOSE 5173

# Set up command to run both services
CMD php artisan serve --host=0.0.0.0 --port=9000 & npm run dev --host 0.0.0.0 --port 5173