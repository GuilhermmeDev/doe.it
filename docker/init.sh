#!/bin/sh

# Caminho do arquivo de flag
FLAG_FILE=/var/www/html/storage/docker_setup_done

# Se o arquivo de flag não existir, executa os comandos de setup
if [ ! -f "$FLAG_FILE" ]; then
    echo "Executando configuração inicial do Laravel..."

    php artisan key:generate
    php artisan migrate:fresh --seed
    php artisan reverb:install
    npm install
    npm run build

    # Cria o arquivo para marcar que a configuração já foi feita
    touch "$FLAG_FILE"
else
    echo "Configuração inicial já foi feita. Pulando..."
fi

# Inicia os serviços em paralelo
php artisan serve --host=0.0.0.0 --port=80 &
php artisan reverb:start &
php artisan queue:work &

# Aguarda que pelo menos um processo falhe antes de encerrar o contêiner
wait

# Finaliza o script com o status do primeiro processo que falhar
exit $?