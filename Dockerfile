# Используйте официальный образ PHP с FPM  
FROM php:8.1-fpm  

# Установите необходимые расширения (например, для MySQL)  
RUN docker-php-ext-install mysqli pdo pdo_mysql  

# Установите рабочую директорию  
WORKDIR /var/www/html 