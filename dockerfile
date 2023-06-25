FROM rdanieli/php74_zts

ENV PHP_MEMORY_LIMIT=-1

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php --install-dir=/bin --filename=composer

COPY . /app

WORKDIR /app

CMD [ "php", "./app.php"]