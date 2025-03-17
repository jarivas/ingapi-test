FROM php:8.3-cli

RUN apt-get -y update
RUN apt-get -y upgrade
RUN apt-get -y install git zip curl

WORKDIR /app

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions zip 
RUN git config --global --add safe.directory /app

RUN adduser dev

USER dev

ENTRYPOINT [ "tail", "-f" ,  "/dev/null"]
