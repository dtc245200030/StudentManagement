FROM php:8.3-fpm-alpine

# 1. Cài đặt các thư viện hệ thống & extension MySQL cho PHP
RUN apk add --no-cache \
    zip unzip libpng-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql bcmath zip

# 2. Lấy Composer chính thức từ Docker Hub
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 3. Copy toàn bộ mã nguồn Laravel vào Container
COPY . .

# 4. Cài đặt các thư viện PHP
RUN composer install --no-dev --optimize-autoloader

# 5. Phân quyền cho thư mục storage và bootstrap/cache của Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 6. HARDENING: Chạy Container bằng user non-root (www-data)
USER www-data

EXPOSE 9000
CMD ["php-fpm"]
