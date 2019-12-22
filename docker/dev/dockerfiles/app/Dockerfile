FROM remyhallot/php:latest

ARG USERID
ARG GROUPID

USER root

RUN if [ "${USERID}" -ne 1000 ]; then \
        usermod -u ${USERID} dockeruser && \
        groupmod -g ${GROUPID} dockergroup && \

        chown -R dockeruser:dockergroup /usr/sbin/apache2 /var/run/apache2 /var/www/project /var/log/apache2; \
    fi

USER dockeruser
