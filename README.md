# Doeit

**Doeit** é um sistema de doações web que conecta doadores e donatários de forma ágil e segura. O sistema permite a validação de cada doação por meio de QR Codes e utiliza tecnologias modernas para garantir uma experiência fluida e intuitiva.

## 🚀 Começando

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e teste.

### 📋 Pré-requisitos

Antes de começar, certifique-se de ter os seguintes itens instalados em sua máquina:

-   PHP >= 8.2
-   Composer
-   MySQL ou outro banco de dados compatível
-   Docker (opcional, se usar o Laravel Sail)
-   Node.js & npm

### 🔧 Instalação

1. Clone o repositório:

```
git clone https://github.com/GuilhermmeDev/doe.it.git
```

2. Instale as dependências do projeto:

```
composer install
npm install && npm run build
```

Configure o arquivo .env:

```
cp .env.example .env
php artisan key:generate
```

Atualize as configurações do banco de dados no arquivo `.env`.

3. Realize as migrações

```
php artisan migrate
```
4. Inicie o servidor de desenvolvimento:

```
php artisan serve &
php artisan reverb:start &
php artisan queue:work &
php artisan schedule:work
```

5. (Opcional) Utilize o Docker com o Laravel Sail:

```
./vendor/bin/sail up -d
```

## 📦 Implantação

Para implantar o projeto em um ambiente de produção:

1. Certifique-se de que o servidor tenha os pré-requisitos instalados.
2. Configure o ambiente `.env` adequadamente.
3. Execute as _migrations_ no banco de dados de produção.
4. Configure o sistema de cache e queue do Laravel conforme necessário.

## 🛠️ Construído com

-   Laravel - Framework PHP
-   Simple QR Code - Geração de QR Codes
-   Laravel Reverb - WebSockets para validação em tempo real
-   Laravel Breeze - Autenticação e UI simples
-   Laravel Sail - Ambiente de desenvolvimento com Docker

## ✒️ Autores

-   **Guilherme Morais** - Back-End - @GuilhermmeDev
-   **Gustavo Chaves** - Back-End - @Gustavo7327
-   Equipe de designers e front-end:
    -   Willian Alves - Front-End - (@willzky23)
    -   Francisco Kauan - Designer - (@kauansiii)
    -   Gustavo Sousa - Front-End - (@gustatxk)
    -   Kauã Silva - Front-End - (@KauaSilvad)
    -   André Vasconcellos - Front-End - (@adrznx)
    -   Nicollas Ryan - Designer

## 📄 Licença

Este projeto está sob a licença Creative Commons (CC BY-NC-SA 4.0) - veja o arquivo [LICENSE.md](https://github.com/GuilhermmeDev/doe.it/blob/main/LICENSE) para detalhes.