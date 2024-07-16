# Use the official PHP image from Docker Hub
FROM php:7.4-cli

# Set the working directory inside the container
WORKDIR /app

# Copy all files from the current directory to /app inside the container
COPY . /app

# Install the mysqli and pdo_pgsql extensions for PHP
RUN docker-php-ext-install mysqli pdo_pgsql

# Set environment variables for PostgreSQL connection
ENV POSTGRES_HOST=https://web-wfo0.onrender.com
ENV POSTGRES_USERNAME=root
ENV POSTGRES_PASSWORD=LjmX4r6w3FM21BZlOyCUmXUZuDiIaZbN
ENV POSTGRES_DATABASE=lovepotion_db

# Set the command to run the PHP server
CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
