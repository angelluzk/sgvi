# Setup do Projeto SGVI

Este documento descreve como configurar o ambiente de desenvolvimento do SGVI.

Seguir exatamente estes passos garante que o sistema funcione corretamente.

---

# Requisitos do Sistema

Antes de iniciar, certifique-se de possuir:

- PHP 8.2 ou superior
- Composer
- MySQL 8
- Node.js 18+
- NPM
- Git

---

# Clonar o Projeto

```bash
git clone https://github.com/SEU-USUARIO/sgvi.git

cd sgvi
````

---

# Instalar Dependências PHP

```bash
composer install
```

---

# Instalar Dependências Frontend

```bash
npm install
```

---

# Configurar Ambiente

Copiar arquivo .env:

```bash
cp .env.example .env
```

Gerar chave:

```bash
php artisan key:generate
```

---

# Configurar Banco de Dados

Editar o arquivo .env:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sgvi
DB_USERNAME=root
DB_PASSWORD=
```

---

# Configurações Obrigatórias

Timezone:

```
APP_TIMEZONE=America/Sao_Paulo
```

Locale:

```
APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=pt_BR
APP_FAKER_LOCALE=pt_BR
```

Session:

```
SESSION_DRIVER=database
```

Cache:

```
CACHE_DRIVER=database
```

Queue:

```
QUEUE_CONNECTION=database
```

---

# Criar Banco

Criar banco manualmente:

```
sgvi
```

Charset:

```
utf8mb4
```

Collation:

```
utf8mb4_unicode_ci
```

Engine:

```
InnoDB
```

---

# Rodar Migrations

```bash
php artisan migrate
```

---

# Popular Banco

```bash
php artisan db:seed
```

---

# Compilar Frontend

Modo desenvolvimento:

```bash
npm run dev
```

Modo produção:

```bash
npm run build
```

---

# Rodar Projeto

```bash
php artisan serve
```

Acessar:

```
http://127.0.0.1:8000
```

---

# Rodar Testes

```bash
php artisan test
```

---

# Qualidade de Código

Formatar código:

```bash
./vendor/bin/pint
```

Análise estática:

```bash
./vendor/bin/phpstan analyse
```

---

# Workflow Recomendado

Antes de commit:

```bash
./vendor/bin/pint

./vendor/bin/phpstan analyse

php artisan test
```

---

# Problemas Comuns

## Erro de Autoload

```bash
composer dump-autoload
```

---

## Erro de Permissão

Linux/Mac:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## Erro de Cache

```bash
php artisan optimize:clear
```

---

# Atualizar Projeto

```bash
git pull

composer install

npm install

php artisan migrate
```

---

# Estrutura do Projeto

```
app/
    Actions/
    Models/
    Http/
        Controllers/
        Requests/

database/
    migrations/
    seeders/

resources/
    views/
```

---

# Ambiente Oficial

Stack oficial:

* Laravel 11
* PHP 8.2+
* MySQL 8
* Blade
* TailwindCSS
* AlpineJS

Sem Vue.

Sem React.

Sem Livewire.

---

# Ordem de Execução Ideal

Sempre executar:

1 Instalar dependências

2 Configurar .env

3 Criar banco

4 Rodar migrations

5 Rodar seeders

6 Compilar frontend

7 Rodar servidor

---

# Verificação Final

Sistema deve:

* Rodar sem erros
* Banco populado
* Rotas funcionando
* Layout carregando

Se tudo funcionar, o ambiente está pronto.