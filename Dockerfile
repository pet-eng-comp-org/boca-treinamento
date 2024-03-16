FROM ghcr.io/joaofazolo/boca-docker/boca-web:1.2.1 



RUN rm -rf /var/www/boca/src
COPY topcom21-treinamento /var/www/boca/src
