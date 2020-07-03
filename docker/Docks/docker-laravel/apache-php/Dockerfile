FROM centos:7.4.1708

RUN yum -y update

# リポジトリ epel, remi
RUN yum -y install epel-release
RUN yum -y install http://rpms.remirepo.net/enterprise/remi-release-7.rpm


# apacheやphpをインストール httpd・・・apacheのサービス名
RUN yum -y install httpd
# --enablerepo・・・リポジトリのインストール
# php-mbstring・・・文字コードに関するライブラリ
# php-mysqlnd・・・mysplと連携する際に必要
# php-pdo・・・PDO(php data access object)との連携
RUN yum -y install --enablerepo=remi,remi-php72 php php-mbstring php-mysqlnd php-pdo php-cli php-common php-devel php-fpm php-gd php-pear php-pecl php-apcu php-xml php-xmlrpc

# Laravelをインストールする時に必要
RUN yum -y install zip unzip

# composerをインストール Laravelを入れる時に必要
RUN curl -sS https://getcomposer.org/installer | php
# curl・・・サーバから、もしくはサーバへデータ転送を行うコマンド

# インストールされたcomposerをコマンドとして使えるようにbin(バイナリファイル)下に移動
RUN mv composer.phar /usr/local/bin/composer

# Apacheが常時起動するようになる
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

# 作業ディレクトリを指定。コンテナにアクセスした時の作業場所となる
WORKDIR /var/www/html