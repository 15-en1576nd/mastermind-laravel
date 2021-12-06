# Install node dependencies
FROM node:16-alpine AS node-builder
WORKDIR /app
COPY ./backend/ .
RUN npm install
RUN npm run production

# Install composer dependencies
FROM composer:latest AS laravel-composer-builder
WORKDIR /app
COPY --from=node-builder /app/ /app/
RUN composer i --optimize-autoloader --no-dev
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache
RUN php artisan optimize

FROM webdevops/php-apache:8.0-alpine AS laravel-runner
WORKDIR /app
COPY --from=laravel-composer-builder /app/ /app/
COPY --from=frontend-builder /app/out/ /app/public/
RUN mkdir resources/views/errors
COPY --from=frontend-builder /app/out/404.html /app/resources/views/errors/404.blade.php
RUN chmod 0777 -R /app/storage/
ENV WEB_DOCUMENT_ROOT /app/public/
# This is stupid, I know this stupid, but I have to do this
# because this garbage framework loads environment variables at
# build time instead of at runtime like ANY properly written software
# or framework. If you have a better solution, please make a PR.
CMD ["bash", "-c", "php artisan config:cache && /usr/bin/python3 /usr/bin/supervisord -c /opt/docker/etc/supervisor.conf --logfile /dev/null --pidfile /dev/null --user root"]