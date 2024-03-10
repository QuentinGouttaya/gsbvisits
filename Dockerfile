FROM php:8.3-fpm

# Install the zip extension
RUN apt-get update && apt-get install -y \
  libzip-dev \
  && docker-php-ext-install zip

# Copy the current directory into the /var/www/html directory of the container
COPY . /var/www/html

# Install the necessary extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Expose the port 9000 used by PHP FPM
EXPOSE 9000