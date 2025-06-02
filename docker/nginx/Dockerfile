FROM nginx

RUN apt-get update \
    && apt-get install -y procps vim

RUN rm /docker-entrypoint.d/10-listen-on-ipv6-by-default.sh
