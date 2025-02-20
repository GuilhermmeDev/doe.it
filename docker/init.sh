#!/bin/sh

# Caminho do arquivo de flag
FLAG_FILE=/var/www/html/storage/docker_setup_done

# Se o arquivo de flag não existir, executa os comandos de setup
if [ ! -f "$FLAG_FILE" ]; then
    echo "Executando configuração inicial do Laravel..."

    php artisan key:generate
    php artisan migrate:fresh --seed
    npm install
    npm run build

    # Cria o arquivo para marcar que a configuração já foi feita
    touch "$FLAG_FILE"
else
    echo "Configuração inicial já foi feita. Pulando..."
fi

# Inicia o servidor normalmente
exec php artisan serve --host=0.0.0.0 --port=80
