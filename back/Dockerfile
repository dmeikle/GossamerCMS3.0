FROM php:8.0-cli
COPY .. /usr/src/gossamer/htdocs
WORKDIR /usr/src/gossamer/htdocs
CMD [ "php", "./web/index.php" ]


ARG USER_ID
ARG GROUP_ID

RUN addgroup --gid $GROUP_ID user
RUN adduser --disabled-password --gecos '' --uid $USER_ID --gid $GROUP_ID user
USER user
