FROM dunglas/frankenphp

# Install extensions required by Laravel
RUN apt-get update && apt-get install -y ffmpeg && install-php-extensions \
    pcntl \
    bcmath \
    gd \
    zip \
    intl \
    pdo_mysql \
    pdo_sqlite

# FIX: Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /app

# Copy our code into the container
COPY . /app

# Set the entrypoint to run migrations and then start the server
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=/app/database/database.sqlite

# Create the SQLite file
RUN touch /app/database/database.sqlite && \
    chmod 777 /app/database/database.sqlite

# Install Composer dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer require php-ffmpeg/php-ffmpeg && composer install --no-dev --optimize-autoloader

ENTRYPOINT ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8080"]
