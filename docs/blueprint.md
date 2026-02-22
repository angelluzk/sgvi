# Blueprint do Projeto SGVI

Este documento define o padrão oficial de desenvolvimento do SGVI.

Nada deve ser implementado fora destas regras.

Este blueprint garante que o sistema permaneça:

- Organizado
- Escalável
- Padronizado
- Profissional
- Fácil de manter

Todo desenvolvedor deve seguir este documento.

---

# Arquitetura Oficial

O sistema segue a arquitetura:

MVC + Actions + Requests

Estrutura principal:

app/

    Actions/

    Models/

    Http/

        Controllers/

        Requests/

---

# Responsabilidades

Cada camada possui responsabilidades bem definidas.

---

## Controllers

Controllers devem ser leves.

Responsabilidades permitidas:

- Receber Request
- Chamar Request de validação
- Chamar Action
- Retornar Response

Controllers nunca devem conter:

- Regra de negócio
- Query direta
- Código pesado

Exemplo correto:

```php
public function store(StoreVinculadoRequest $request)
{
    app(CreateVinculadoAction::class)->execute(
        $request->validated()
    );

    return redirect()->route('vinculados.index');
}
````

---

## Requests

Requests são responsáveis pela validação.

Localização:

app/Http/Requests

Responsabilidades:

* Validação
* Autorização
* Regras simples

Exemplo:

```php
public function rules()
{
    return [
        'nome' => 'required|string|max:255'
    ];
}
```

---

## Actions

Actions são responsáveis pela lógica de negócio.

Localização:

app/Actions

Responsabilidades:

* Regras de negócio
* Manipulação de dados
* Persistência

Toda Action deve possuir:

execute()

Exemplo:

```php
class CreateVinculadoAction
{
    public function execute(array $data)
    {
        return Vinculado::create($data);
    }
}
```

---

## Models

Models representam as tabelas.

Responsabilidades:

* Relacionamentos
* Scopes
* Accessors
* Mutators

Models não devem conter:

* Regras complexas
* Lógica pesada

---

## Views

As Views utilizam Blade.

Responsabilidades:

* Exibição de dados
* Estrutura visual

Views nunca devem conter:

* Queries
* Regra de negócio
* Código PHP complexo

---

# Fluxo Oficial

Todo fluxo do sistema deve seguir:

User

→ Route

→ Controller

→ Request

→ Action

→ Model

→ Response

Nenhuma funcionalidade deve quebrar este fluxo.

---

# Padrão de Nomes

Os nomes devem seguir padrões consistentes.

---

## Controllers

Formato:

EntidadeController

Exemplo:

VinculadoController

---

## Requests

Formato:

StoreEntidadeRequest

UpdateEntidadeRequest

Exemplo:

StoreVinculadoRequest

UpdateVinculadoRequest

---

## Actions

Formato:

CreateEntidadeAction

UpdateEntidadeAction

DeleteEntidadeAction

ListEntidadeAction

Exemplo:

CreateVinculadoAction

UpdateVinculadoAction

DeleteVinculadoAction

ListVinculadoAction

---

## Models

Formato:

Entidade

Exemplo:

Vinculado

---

# Banco de Dados

O banco deve ser normalizado.

O núcleo do sistema é a tabela:

vinculados

Todas as entidades relacionadas devem respeitar o MER definido.

Nunca:

* Criar tabelas fora do MER
* Duplicar dados
* Quebrar relacionamentos

---

# Qualidade de Código

Todo código deve passar por:

Laravel Pint

```
./vendor/bin/pint
```

PHPStan

```
./vendor/bin/phpstan analyse
```

Testes

```
php artisan test
```

O CI valida automaticamente.

---

# Hooks Git

O projeto utiliza hook pre-commit.

Arquivo:

.git/hooks/pre-commit

Executa automaticamente:

* Pint
* PHPStan
* Testes

Garantindo que código inválido não seja commitado.

---

# Regras Absolutas

Sempre:

* Controllers leves
* Requests para validação
* Actions para lógica
* Banco normalizado
* Código limpo

Nunca:

* Regra em Controller
* Query em Blade
* Código duplicado
* Quebrar arquitetura

---

# Decisões Arquiteturais

MVC + Actions foi escolhido para:

* Separação clara
* Código previsível
* Escalabilidade
* Organização profissional

---

# Objetivo

O objetivo do Blueprint é garantir que o SGVI permaneça:

* Limpo
* Previsível
* Organizado
* Profissional

Qualquer mudança estrutural deve atualizar este documento.