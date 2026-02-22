# SGVI - Arquitetura do Sistema

Este documento define a arquitetura oficial do sistema **SGVI**.

Toda implementação deve seguir este padrão.

Não quebrar arquitetura sem decisão técnica formal.

---

# Stack Oficial

O sistema utiliza:

- Laravel 11
- PHP 8.2+
- MySQL 8
- Blade
- TailwindCSS
- AlpineJS
- Vite

Frontend server-side renderizado.

Não utilizar:

- Vue
- React
- Livewire

---

# Padrão Arquitetural

O sistema segue:

MVC + Actions

Separação obrigatória:

Controllers → Recebem requisições  
Requests → Validam dados  
Actions → Regra de negócio  
Models → Relacionamentos  
Blade → Interface

---

# Estrutura Oficial de Pastas

```

app/
├ Actions/
│   └ Vinculados/
│
├ DTOs/
│
├ Http/
│   ├ Controllers/
│   └ Requests/
│
├ Models/
│
├ Observers/
│
├ Policies/
│
├ Providers/
│
├ Services/
│
└ Traits/

````

---

# Responsabilidade por Camada

## Controllers

Responsáveis apenas por:

- Receber requisição
- Chamar Actions
- Retornar respostas

Controllers devem ser leves.

Exemplo correto:

```php
public function store(StoreVinculadoRequest $request)
{
    $vinculado = StoreVinculadoAction::execute($request->validated());

    return redirect()->route('vinculados.show', $vinculado);
}
````

Controllers **não podem conter regra de negócio.**

---

## Requests

Responsáveis por:

* Validação
* Sanitização
* Tipagem de dados

Exemplo:

```php
public function rules(): array
{
    return [
        'pessoa_id' => ['required','integer'],
        'instituicao_id' => ['required','integer'],
        'cargo_id' => ['required','integer'],
    ];
}
```

---

## Actions

Responsáveis por:

* Regra de negócio
* Persistência
* Transações

Exemplo:

```php
class StoreVinculadoAction
{
    public static function execute(array $data): Vinculado
    {
        return Vinculado::create($data);
    }
}
```

Actions são o núcleo da aplicação.

Toda regra deve estar nelas.

---

## Models

Responsáveis apenas por:

* Relacionamentos
* Casts
* Scopes simples

Models não devem conter lógica pesada.

Exemplo correto:

```php
public function pessoa()
{
    return $this->belongsTo(Pessoa::class);
}
```

---

## DTOs

DTOs são responsáveis por:

* Estruturar dados
* Tipagem forte
* Transferência entre camadas

Exemplo:

```php
class VinculadoDTO
{
    public function __construct(
        public int $pessoa_id,
        public int $instituicao_id,
        public int $cargo_id
    ) {}
}
```

DTOs devem ser usados em Actions complexas.

---

## Services

Services são utilizados para:

* Integrações externas
* APIs
* Processamentos complexos

Exemplo:

* Integração com API externa
* Importação de dados
* Processamentos pesados

---

## Observers

Observers são responsáveis por:

* Eventos de Models

Exemplo:

* created
* updated
* deleted

---

## Policies

Policies são responsáveis por:

* Controle de acesso
* Autorização

Exemplo:

```php
public function update(User $user, Vinculado $vinculado)
{
    return $user->instituicao_id === $vinculado->instituicao_id;
}
```

---

## Providers

Providers são responsáveis por:

* Registro de serviços
* Bindings
* Configuração global

Exemplo:

* Bind de Services
* Observers
* Macros

---

# Núcleo do Sistema

O núcleo do sistema é:

VINCULADOS

Tabela central:

```
vinculados
```

Relacionamentos principais:

```
Pessoa → Vinculado → Instituição
Pessoa → Vinculado → Cargo
Pessoa → Vinculado → Departamento
Pessoa → Vinculado → Função
```

---

# Regra Fundamental do Sistema

Pessoa **NUNCA possui cargo diretamente.**

Sempre:

```
Pessoa → Vinculado → Cargo
```

Errado:

```
Pessoa → Cargo
```

Correto:

```
Pessoa → Vinculado → Cargo
```

Toda regra do sistema deve respeitar isso.

---

# Banco de Dados

O banco deve ser:

* Normalizado
* Relacional
* Consistente

O MER é a verdade do sistema.

Nunca quebrar MER.

---

# Performance

Regras obrigatórias:

Sempre utilizar eager loading:

```php
Vinculado::with([
    'pessoa',
    'instituicao',
    'cargo'
])->paginate();
```

Nunca fazer:

```php
Vinculado::all();
```

Evitar N+1 queries.

---

# Clean Code

Obrigatório:

* Código tipado
* Métodos curtos
* Nomes claros
* Sem duplicação
* Controllers leves
* Actions organizadas

---

# Code Style

O projeto utiliza:

Laravel Pint

Obrigatório rodar antes de commits.

---

# CI/CD

Toda Pull Request executa:

* Pint
* PHPStan
* Testes

Código que falhar não deve ser aceito.

---

# Regra Final

Se surgir dúvida arquitetural:  
    Seguir este documento.