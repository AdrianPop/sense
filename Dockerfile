FROM icalialabs/wkhtmltopdf:0.12.5-alpine3.7 as wkhtmltopdf-source


FROM php:7.2.20-fpm-alpine3.9

RUN apk add --no-cache icu-dev libxslt-dev autoconf g++ libtool make gd libpng-dev \
    ghostscript supervisor \
    libgcc libstdc++ libx11 glib libxrender libxext libintl \
    ca-certificates openrc sudo nano

RUN docker-php-ext-install pdo_mysql xsl gd zip
RUN docker-php-ext-enable zip

RUN mkdir -p /tmp/cache/dev/profiler \
    && mkdir -p /tmp/cache/dev/profiler \
    && mkdir -p /tmp/cache/dev/pools \
    && mkdir -p /tmp/cache/dev/doctrine \
    && mkdir -p /tmp/cache/dev/translations \
    && mkdir -p /tmp/cache/dev/twig \
    && mkdir -p /tmp/cache/prod/profiler \
    && mkdir -p /tmp/cache/prod/pools \
    && mkdir -p /tmp/cache/prod/doctrine \
    && mkdir -p /tmp/cache/prod/translations \
    && mkdir -p /tmp/cache/dev/twig \
    && mkdir -p /tmp/logs \
    && touch /tmp/logs/dev.log \
    && touch /tmp/logs/prod.log \
    && chmod 777 /tmp/logs -R \
    && chmod 777 /tmp/cache -R \
    && chmod 777 /tmp/cache/dev/ -R

RUN apk add --no-cache --repository http://dl-cdn.alpinelinux.org/alpine/v3.8/main \
      --repository http://dl-cdn.alpinelinux.org/alpine/v3.8/community \
      curl icu-libs unzip zlib-dev musl mesa-gl mesa-dri-swrast \
      libreoffice=5.4.5.1-r3 libreoffice-base=5.4.5.1-r3 libreoffice-common=5.4.5.1-r3 \
      libreoffice-lang-uk=5.4.5.1-r3 libreoffice-lang-fr=5.4.5.1-r3 \
      fontconfig freetype ttf-dejavu ttf-droid ttf-freefont ttf-liberation ttf-ubuntu-font-family \
      libstdc++ dbus-x11 openjdk8-jre libssl1.0 \
      && rm -rf /tmp/*

RUN docker-php-ext-install intl

RUN addgroup app && adduser -D -G app app && echo "app ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers

COPY --from=wkhtmltopdf-source /bin/wkhtmltopdf /bin/wkhtmltopdf

COPY ./php.ini /usr/local/etc/php/conf.d/php.ini

RUN mkdir /run/openrc/ && touch /run/openrc/softlevel

CMD ["docker-php-entrypoint", "php-fpm"]
