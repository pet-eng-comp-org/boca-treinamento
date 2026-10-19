# BOCA de treinamento do Topcom: a boca-web oficial (boca-docker 1.2.3, BOCA 1.5.24)
# com as personalizações do PET por cima: visual do Topcom, tela de login e autocadastro.
FROM ghcr.io/pet-eng-comp-org/boca-treinamento/web-base:1.2.3-20261019@sha256:5e02c02d5b5736aee6da00ba1378f47b98488068d0edf978d27b87c07c36bef4

LABEL org.opencontainers.image.source="https://github.com/pet-eng-comp-org/boca-treinamento"

USER root
COPY --chown=www-data:www-data personalizacao /var/www/boca/src
# mesmas permissões que o boca-web.postinst aplica na imagem oficial
RUN chmod -R go-rwx /var/www/boca/src/private
# O BOCA 1.5.24 gera milhares de warnings por página de problemas (a estatística de
# dificuldade percorre usuários sem submissão). Em produção, só erros vão ao log.
RUN printf 'error_reporting = E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED\ndisplay_errors = Off\n' \
      > "$(php -r 'echo PHP_CONFIG_FILE_SCAN_DIR;' | sed 's#/cli/#/apache2/#')/99-boca-treinamento.ini"
COPY init-pet.sh /init-pet.sh
RUN chmod 755 /init-pet.sh
USER www-data
ENTRYPOINT ["/init-pet.sh"]
