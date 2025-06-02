FROM php:8.2-fpm

# Установка локалей
RUN apt-get update && \
    apt-get install -y locales && \
    sed -i 's/# en_GB.UTF-8 UTF-8/en_GB.UTF-8 UTF-8/' /etc/locale.gen && \
    sed -i 's/# it_IT.UTF-8 UTF-8/it_IT.UTF-8 UTF-8/' /etc/locale.gen && \
    locale-gen

# Установка необходимых зависимостей
RUN apt-get update && apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        wget \
        libldb-dev \
        vim \
        unzip \
        zip \
        libzip-dev \
        libpq-dev \
        libgd-dev \
        libjpeg-dev \
        libgif-dev \
        iputils-ping \
        sshpass \
        ssh \
        apt-utils \
        libaio1 \
        && docker-php-ext-install -j$(nproc) sockets pcntl \
        && docker-php-ext-install -j$(nproc) gd \
        ## Install Composer
        && curl -sS https://mirrors.aliyun.com/composer/composer.phar  -o /usr/local/bin/composer \
        && chmod +x /usr/local/bin/composer \
        && composer --version

# Установка расширения ZIP
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

# Установка расширения PDO_MySQL
RUN docker-php-ext-install pdo_mysql

# Установка Oracle Instant Client и OCI8
# Копирование локальных файлов Oracle Instant Client
# Установка Oracle Instant Client и OCI8
# Копирование локальных файлов Oracle Instant Client
COPY oracle-instantclient/instantclient-basiclite-linux.x64-23.8.0.25.04.zip /opt/oracle/
COPY oracle-instantclient/instantclient-sdk-linux.x64-23.8.0.25.04.zip /opt/oracle/

# Проверка наличия файлов
RUN ls -la /opt/oracle/

# Установка Oracle Instant Client
RUN apt-get update && apt-get install -y --no-install-recommends \
        libaio1 \
        unzip \
    && mkdir -p /opt/oracle \
    && cd /opt/oracle \
    && unzip -o instantclient-basiclite-linux.x64-23.8.0.25.04.zip || { echo "Failed to unzip basiclite"; exit 1; } \
    && unzip -o instantclient-sdk-linux.x64-23.8.0.25.04.zip || { echo "Failed to unzip sdk"; exit 1; } \
    && echo "/opt/oracle/instantclient_23_8" > /etc/ld.so.conf.d/oracle-instantclient.conf \
    && ldconfig \
    && rm -rf instantclient-basiclite-linux.x64-23.8.0.25.04.zip \
    && rm -rf instantclient-sdk-linux.x64-23.8.0.25.04.zip

# Настройка переменной окружения LD_LIBRARY_PATH
ENV LD_LIBRARY_PATH=/opt/oracle/instantclient_23_8:$LD_LIBRARY_PATH

# Установка расширения OCI8
RUN echo "instantclient,/opt/oracle/instantclient_23_8" | pecl install oci8-3.4.0 \
    && docker-php-ext-enable oci8

# Установка расширений PostgreSQL
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql

# Настройка пользователя
USER root

COPY ./php.ini /usr/local/etc/php/php.ini

ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

USER www-data

WORKDIR /var/www/app

RUN chown ${USER}:${USER} -R .

EXPOSE 9000
CMD ["php-fpm"]
