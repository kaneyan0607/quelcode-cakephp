FROM php:7.3-fpm

# 1000を適宜変更し、hostのuidにguestのuidを合わせる
# ホスト側でidコマンドを打って調べたuidの値にする
ARG DOCKER_UID=501
ARG DOCKER_USER=docker
ARG DOCKER_PASSWORD=docker

# composerをインストール
RUN curl -s https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Node.jsの準備
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -

# 各種インストール
RUN apt-get update \
  && apt-get install -y git zip unzip \
  && apt-get install -y sudo \
  && apt-get install -y vim \
  && apt-get install -y nodejs \
  && apt-get install -y libicu-dev \
  && docker-php-ext-install pdo_mysql intl mbstring

# ユーザ作成
RUN useradd -m --uid ${DOCKER_UID} --groups sudo ${DOCKER_USER} \
  && echo ${DOCKER_USER}:${DOCKER_PASSWORD} | chpasswd

# 作成したユーザーに切り替える
USER ${DOCKER_USER}

# 作業ディレクトリを変更
WORKDIR /var/www/html
