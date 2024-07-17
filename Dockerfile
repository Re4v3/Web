# Use the official PHP image from Docker Hub
FROM php:7.4-cli

# Set the working directory inside the container
WORKDIR /app

# Update package lists and install required packages
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install the mysqli and pgsql extensions for PHP
RUN docker-php-ext-install mysqli pgsql

# Copy all files from the current directory to /app inside the container
COPY . /app

# Set environment variables for PostgreSQL connection
ENV POSTGRES_HOST=dpg-cqb74iuehbks73dkm78g-a
ENV POSTGRES_USERNAME=root
ENV POSTGRES_PASSWORD=LjmX4r6w3FM21BZlOyCUmXUZuDiIaZbN
ENV POSTGRES_DATABASE=lovepotion_db

# Set the command to run the PHP server
CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
