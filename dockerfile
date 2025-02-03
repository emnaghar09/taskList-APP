# Utilisation de PHP 8.2 avec FPM 
FROM php:8.2-fpm

# Installation des dépendances nécessaires
RUN apt-get update && apt-get install -y \
    librabbitmq-dev \
    unzip \
    git \
    libzip-dev && \
    docker-php-ext-install amqp zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html

# Donner les bons droits aux fichiers
RUN chown -R www-data:www-data /var/www/html

# Exposer le port
EXPOSE 9000
