FROM webdevops/php-nginx:8.3-alpine

WORKDIR /app

COPY . /app

ENV WEB_DOCUMENT_ROOT=/app/public
ENV APP_ENV=production

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

RUN php artisan package:discover --ansi || true
RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 80

CMD php artisan migrate --force || true && /entrypoint supervisord