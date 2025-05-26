# Dockerfile
FROM dunglas/frankenphp

# Copie le code source
COPY . /app

# Définir le dossier de travail
WORKDIR /app

# Installe les dépendances PHP
RUN apt-get update && \
    apt-get install -y git unzip && \
    curl -sS https://getcomposer.org/installer | php && \
    php composer.phar install --no-scripts --no-interaction && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Expose le port HTTP et HTTPS
EXPOSE 80 443
