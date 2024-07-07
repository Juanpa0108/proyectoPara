FROM mysql:latest
COPY init.sql /docker-entrypoint-initdb.d/
ENV MYSQL_ALLOW_EMPTY_PASSWORD=yes
EXPOSE 3306
