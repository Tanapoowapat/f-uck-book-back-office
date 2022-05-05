FROM yiisoftware/yii2-php:7.4-apache

COPY . /app

RUN composer install
RUN chmod -R 777 /app
