# Workflow de Desenvolvimento SGVI

Este documento define o fluxo oficial de desenvolvimento do projeto SGVI.

Todos os desenvolvedores devem seguir este padrão.

Este workflow garante:

- Código limpo
- Padronização
- Integração contínua estável
- Histórico organizado
- Qualidade profissional

---

# Branches Oficiais

O projeto possui duas branches principais:

## main

Branch de produção.

Regras:

- Sempre estável
- Nunca desenvolver diretamente
- Recebe apenas merge da develop

---

## develop

Branch de desenvolvimento.

Regras:

- Base de trabalho
- Features são integradas aqui
- Pode receber commits diários

---

# Fluxo Oficial

Fluxo correto:

```

Nova Feature
↓
Branch Feature
↓
Commit
↓
Push
↓
Pull Request → develop
↓
CI aprovado
↓
Merge

````

---

# Criar Nova Feature

Sempre criar branch a partir da develop.

```bash
git checkout develop

git pull

git checkout -b feature/nome-da-feature
````

Exemplo:

```
feature/cadastro-pessoas
feature/cadastro-instituicoes
feature/vinculos
```

---

# Padrão de Commits

Commits devem seguir padrão profissional.

Formato:

```
tipo: descrição
```

Tipos permitidos:

```
feat:
fix:
refactor:
chore:
test:
docs:
```

---

## Exemplos

```
feat: criar migration pessoas

feat: implementar PessoaController

fix: corrigir validação de email

refactor: melhorar CreateVinculoAction

docs: atualizar blueprint

test: criar teste de vinculo
```

---

# Regras de Commit

Antes de commit:

Obrigatório rodar:

```
./vendor/bin/pint

./vendor/bin/phpstan analyse

php artisan test
```

Nunca commitar com erro.

---

# Pre-commit Hook

O projeto possui pre-commit configurado.

Arquivo:

```
.git/hooks/pre-commit
```

Ele roda automaticamente:

```
./vendor/bin/pint
```

Objetivo:

* Garantir padrão de código
* Evitar erro no CI
* Evitar commits quebrados

---

# Como Criar o Pre-commit

Entrar na pasta:

```bash
cd .git/hooks
```

Criar arquivo:

```bash
touch pre-commit
```

Conteúdo:

```bash
#!/bin/sh

echo "Rodando Laravel Pint..."

./vendor/bin/pint

git add .

echo "Pint finalizado."
```

Dar permissão:

```bash
chmod +x pre-commit
```

---

# Pull Requests

Sempre usar Pull Request.

Nunca dar push direto na main.

---

## Regras do Pull Request

Pull Request deve:

* Ter título claro
* Ter descrição
* Passar no CI
* Não ter erro Pint
* Não ter erro PHPStan
* Não quebrar testes

---

## Exemplo de PR

Título:

```
feat: cadastro de instituições
```

Descrição:

```
Implementa CRUD completo de instituições.

- Migration
- Model
- Controller
- Requests
- Rotas
```

---

# Integração Contínua (CI)

Arquivo:

```
.github/workflows/ci.yml
```

O CI roda automaticamente em:

* Push
* Pull Request

---

## O CI executa

### Setup

* Instala PHP
* Instala Composer
* Instala Node
* Instala dependências

---

### Banco

* Cria banco MySQL
* Roda migrations

---

### Frontend

* Instala NPM
* Compila assets

---

### Qualidade

Roda:

```
./vendor/bin/pint --test
```

Verifica padrão de código.

---

Roda:

```
./vendor/bin/phpstan analyse
```

Verifica erros de tipagem.

---

### Testes

Roda:

```
php artisan test
```

---

# Falha no CI

Se o CI falhar:

Nunca fazer merge.

Corrigir localmente:

```
./vendor/bin/pint

./vendor/bin/phpstan analyse

php artisan test
```

Depois:

```
git commit

git push
```

---

# Merge Strategy

Sempre usar:

```
Squash and Merge
```

Motivo:

* Histórico limpo
* Profissional
* Fácil auditoria

---

# Atualizar Branch

Sempre atualizar antes de trabalhar:

```bash
git checkout develop

git pull
```

Depois:

```bash
git checkout feature/nome

git merge develop
```

---

# Resolver Conflitos

Após merge:

```bash
./vendor/bin/pint
```

Depois:

```bash
git add .

git commit
```

---

# Nunca Fazer

Nunca:

* Commitar direto na main
* Ignorar Pint
* Ignorar PHPStan
* Ignorar testes
* Colocar regra de negócio em Controller
* Mudar banco sem atualizar blueprint

---

# Ordem Oficial de Desenvolvimento

Seguir sempre:

1 Ambiente

2 Migrations

3 Models

4 Seeders

5 Requests

6 Controllers

7 Actions

8 Rotas

9 Testes

10 Blade

Nunca inverter.

---

# Definição de Concluído

Uma tarefa só está pronta quando:

* Código limpo
* Pint OK
* PHPStan OK
* Testes OK
* CI OK
* Blueprint respeitado