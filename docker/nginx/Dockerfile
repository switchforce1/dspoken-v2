ARG NGINX_VERSION=1.18

# "nginx" stage
# depends on the "php" stage above
FROM nginx:${NGINX_VERSION}-alpine AS symfony_nginx

COPY ./conf.d/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /srv/app

# COPY --from=symfony_php /srv/app/public public/
