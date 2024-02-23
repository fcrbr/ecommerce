FROM ubuntu:23.04

RUN apt update && apt install -y php7.2-cli php7.2-fpm

COPY . /app

WORKDIR /app

CMD ["php-fpm", "-F"]
