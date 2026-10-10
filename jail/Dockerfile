# Jail do BOCA de treinamento: a boca-jail oficial (boca-docker 1.2.3, BOCA 1.5.24) com o
# autojudging.php de antes do commit e46ca73 do rlaiola/boca.
#
# Esse commit passou a usar o código de saída do script compare como número da resposta.
# Os pacotes de problema no formato do BOCA (os do Topcom e os exemplos do próprio BOCA)
# saem com 4 quando a saída bate, e 4 na tabela de respostas é "Time limit exceeded":
# toda solução certa virava TLE. Também deixou de parar no primeiro caso errado, e a
# resposta passou a ser a do último caso de teste.
FROM ghcr.io/pet-eng-comp-org/boca-treinamento/jail-base:1.2.3-20261010@sha256:e5b25a149f87cfd89133274a8cd332fd47135e99834fb35087ee96074befbf32

LABEL org.opencontainers.image.source="https://github.com/pet-eng-comp-org/boca-treinamento"

# mesmo dono e permissão do arquivo original da imagem
COPY --chown=www-data:www-data --chmod=755 personalizacao/private/autojudging.php /var/www/boca/src/private/autojudging.php
