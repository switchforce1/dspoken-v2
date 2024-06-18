FROM dunglas/frankenphp:php8.3

COPY . /app/public

ENTRYPOINT [ "tail", "-f", "/;dev/null"]