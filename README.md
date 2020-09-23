# Hyper payment API

Bem vindo ao repositório do Hyper payment API. 
Essa API forncece ao seu utilizador a possibilidade de mediar transações entre diferentes tipos de usuários, nesse caso, entre clientes e lojistas.

## Escopo da API
Temos 2 tipos de usuários, os comuns e lojistas, ambos têm carteira com dinheiro e realizam transferências entre eles. Vamos nos atentar **somente** ao fluxo de transferência entre dois usuários.

### Requisitos:

- Para ambos tipos de usuário, precisamos do Nome Completo, CPF, e-mail e Senha. CPF/CNPJ e e-mails devem ser únicos no sistema. Sendo assim, seu sistema deve permitir apenas um cadastro com o mesmo CPF ou endereço de e-mail.

- Usuários podem enviar dinheiro (efetuar transferência) para lojistas e entre usuários. 

- Lojistas **só recebem** transferências, não enviam dinheiro para ninguém.

- Antes de finalizar a transferência, deve-se consultar um serviço autorizador externo.

- A operação de transferência deve ser uma transação (ou seja, revertida em qualquer caso de inconsistência) e o dinheiro deve voltar para a carteira do usuário que envia.

- No recebimento de pagamento, o usuário ou lojista precisa receber notificação enviada por um serviço de terceiro e eventualmente este serviço pode estar indisponível/instável.

## Setup do projeto
- Linguagem: PHP 7.2
- Framework: Lumen versão 7.2.2 / Laravel Components ^7.0
- Banco de dados: Mysql 5.6

## Dependências
- Docker
- Docker compose

## Instruções para rodar

Antes de tudo, entre na pasta lumen e renomeie o arquivo `.env.example` para `.env` afim de garantir que as variaveis de ambiente fiquem certas assim como para com os testes.

### Execute o arquivo `run.sh` na raiz do projeto:

`sh ./run.sh`

Este comando irá executar alguns passos e você pode acompanhar via terminal:
1) Abrir diretório docker na raiz
2) Subir os containers Docker em sua máquina local
3) Instalação das dependências
3) Execução das Migrations
4) Execução das Seeds
5) Iniciar o processamento de filas localmente

Após esses passos o ambiente poderá ser acessado através do **http://localhost**

## Estrutura do banco de dados
![database structure](/images/db-structure.png)

## Estrutura processamento das transações
![transaction flow](/images/transaction-flow.png)

## Agenda evolutiva de melhorias

### Legenda
Já implementado    :white_check_mark: 

Proposta de melhoria (ROADMAP)  :black_square_button: 

### Melhorias
- Notificar o pagador caso a transferência não tenha sido autorizada :white_check_mark:
- Validar se o pagador e o recebedor não são a mesma pessoa :white_check_mark:
- Não permitir transações idênticas num curto período de tempo :black_square_button:
- Utilizar UUID como o identificador do pagador e do recebedor ao invés do ID incremental (sigilo comercial) :black_square_button: 

## Testes unitários e integração
Para executar os testes unitários e de integração, basta executar o seguinte comando na raiz do projeto
```
./vendor/bin/phpunit --testdox tests
```
### Retorno esperado:
```
PHPUnit 9.3.10 by Sebastian Bergmann and contributors.

Transaction Integration
 ✔ Transaction with service authorized
 ✔ Transaction with service unauthorized
 ✔ Send mail with service authorized
 ✔ Send mail with service unauthorized

Transaction Unit
 ✔ Invalid payer type
 ✔ Zero amount transaction provided
 ✔ Transaction between same users
 ✔ Creat transaction with valid params

Time: 00:01.922, Memory: 24.00 MB

OK (8 tests, 11 assertions)
```
## Endpoints

POST /transaction

```json
{
    "value" : 100.00,
    "payer" : 4,
    "payee" : 15
}
```
