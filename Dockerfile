FROM dunglas/frankenphp

# Install extensions required by Laravel
RUN install-php-extensions \
    pcntl \
    bcmath \
    gd \
    zip \
    intl \
    pdo_mysql \
    pdo_sqlite

# Copy our code into the container
COPY . /app

# Set the entrypoint to run migrations and then start the server
# We use SQLite for this quick MVP so we don't need an external DB
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=/app/database/database.sqlite

# Create the SQLite file
RUN touch /app/database/database.sqlite && \
    chmod 777 /app/database/database.sqlite

# Install Composer dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader

# Run migrations automatically when the container builds
RUN php artisan migrate --force --seed

ENTRYPOINT ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8080"]
