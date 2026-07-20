FROM php:8.3-fpm

# Install system dependencies & PHP extensions (termasuk pdo_pgsql untuk Supabase)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    nodejs \
    npm

RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# Copy Composer dari official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Beri izin eksekusi dan jalankan build script Laravel
RUN chmod +x render-build.sh
RUN ./render-build.sh

EXPOSE 10000

CMD php artisan serve --host 0.0.0.0 --port $PORT
