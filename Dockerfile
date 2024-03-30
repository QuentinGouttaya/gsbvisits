FROM php:8.3-cli

# Install the zip extension
RUN apt-get update && apt-get install -y \
  libzip-dev \
  && docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the current directory into the /var/www/html directory of the container
COPY . /var/www/html

# Install the necessary extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install application dependencies
RUN cd /var/www/html && composer install

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Expose the port 4400 used by the PHP development server
EXPOSE 4400
