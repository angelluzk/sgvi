# Workflow de Desenvolvimento - SGVI

Este documento descreve o fluxo de desenvolvimento do sistema SGVI, incluindo:

- GitHub Actions (CI)
- Laravel Pint (Padronização de código)
- PHPStan (Análise estática)
- Testes automatizados
- Hooks locais do Git

Este fluxo garante que o código esteja sempre:

- Padronizado
- Testado
- Estável
- Profissional

---

# 1. GitHub Actions (CI)

Arquivo:

```

.github/workflows/ci.yml

```

O CI executa automaticamente quando ocorre:

- Push na branch `main`
- Push na branch `develop`
- Pull Requests

### O CI executa:

## 1.1 Setup do Ambiente

- Ubuntu Latest
- PHP 8.4
- Node 20
- MySQL 8

## 1.2 Instala Dependências

### Composer

```

composer install

```

### NPM

```

npm ci

```

---

## 1.3 Configuração do Laravel

### Copia .env

```

cp .env.example .env

```

### Gera chave

```

php artisan key:generate

```

---

## 1.4 Banco de Dados

Banco temporário MySQL:

```

Database: testing
User: root
Password: root

```

Executa:

```

php artisan migrate

```

---

## 1.5 Build do Frontend

Executa:

```

npm run build

```

---

# 2. Padronização de Código

Ferramenta:

Laravel Pint

Comando usado no CI:

```

./vendor/bin/pint --test

```

Se houver erro de estilo:

```

FAIL — style issues

```

O CI falha.

---

## Como corrigir

Rodar localmente:

```

./vendor/bin/pint

```

Depois:

```

git add .
git commit
git push

```

---

# 3. Análise Estática

Ferramenta:

PHPStan + Larastan

Comando:

```

./vendor/bin/phpstan analyse

```

Objetivo:

- Detectar erros antes de rodar
- Melhorar qualidade
- Evitar bugs

---

# 4. Testes Automatizados

Executado no CI:

```

php artisan test

```

Os testes devem sempre passar antes do merge.

---

# 5. Git Hook Automático (Pint)

Arquivo:

```

.git/hooks/pre-commit

```

Esse hook roda automaticamente antes de cada commit.

### Objetivo

Garantir que o código sempre esteja no padrão Pint.

### Conteúdo:

```

#!/bin/sh

echo "Rodando Laravel Pint..."

./vendor/bin/pint

git add .

echo "Pint finalizado."

```

---

# 6. Instalação do Hook (Obrigatório)

Após clonar o projeto:

Entrar na pasta hooks:

```

cd .git/hooks

```

Criar arquivo:

```

touch pre-commit

```

Abrir:

```

code pre-commit

```

Colar:

```

#!/bin/sh

echo "Rodando Laravel Pint..."

./vendor/bin/pint

git add .

echo "Pint finalizado."

```

Dar permissão:

```

chmod +x pre-commit

```

---

# 7. Fluxo Correto de Desenvolvimento

Fluxo recomendado:

## 1 - Criar feature branch

```

git checkout develop
git pull
git checkout -b feature/nome

```

---

## 2 - Desenvolver

Exemplo:

```

php artisan make:model
php artisan make:migration

```

---

## 3 - Antes do commit

Se hook estiver ativo:

Nada necessário.

Se não estiver:

```

./vendor/bin/pint

```

---

## 4 - Commit

```

git commit -m "feat: descrição"

```

---

## 5 - Push

```

git push origin feature/nome

```

---

## 6 - Pull Request

Abrir PR para:

```

develop

```

O CI será executado automaticamente.

---

## 7 - Merge

Só fazer merge se:

✔ CI passou  
✔ Testes passaram  
✔ PHPStan passou  
✔ Pint passou  

---

# 8. Estrutura de Qualidade

O projeto utiliza:

- Laravel 11
- MySQL 8
- Blade
- Tailwind
- Alpine
- Actions Pattern
- Clean Code

---

# 9. Ferramentas de Qualidade

## Pint

Padronização de código.

```

./vendor/bin/pint

```

---

## PHPStan

Análise estática.

```

./vendor/bin/phpstan analyse

```

---

## Testes

```

php artisan test

```

---

# 10. Problemas Comuns

## CI falhou no Pint

Erro:

```

FAIL — style issues

```

Solução:

```

./vendor/bin/pint

```

---

## CI falhou no PHPStan

Erro:

```

PHPStan detected errors

```

Solução:

Corrigir código apontado.

---

## CI falhou nos testes

Erro:

```

Tests failed

```

Solução:

Corrigir testes ou código.

---

# 11. Boas Práticas

Sempre:

✔ Criar branch nova  
✔ Rodar Pint  
✔ Rodar testes  
✔ Fazer Pull Request  

Nunca:

❌ Commit direto na main  
❌ Ignorar CI  
❌ Ignorar Pint  
❌ Ignorar PHPStan  

---

# 12. Resumo do Pipeline

Ordem de execução:

1 - Composer install  
2 - .env  
3 - Key generate  
4 - Migrate  
5 - NPM install  
6 - Build assets  
7 - Pint  
8 - PHPStan  
9 - Tests

---

# 13. Objetivo

Garantir que o SGVI seja um sistema:

- Estável
- Profissional
- Padronizado
- Seguro
- Escalável