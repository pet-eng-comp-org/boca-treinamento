# BOCA de treinamento do Topcom: a boca-web oficial (rlaiola/boca-docker 1.2.3)
# com a pasta src do PET por cima. Essa src é um BOCA anterior ao 1.5.17 (sem login
# LDAP/Google) com o visual, o placar e o autocadastro do PET.
FROM ghcr.io/rlaiola/boca-docker/boca-web:1.2.3@sha256:282b56728420ba451bcbe8d9ff1e5af317a68b20e9c2fe4d3bcd080d10abdf72

USER root
RUN rm -rf /var/www/boca/src
COPY --chown=www-data:www-data src /var/www/boca/src
# mesmas permissões que o boca-web.postinst aplica na imagem oficial
RUN chmod -R go-rwx /var/www/boca/src/private
USER www-data
