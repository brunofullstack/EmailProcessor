```markdown
# Successful Emails API

Esta é a API para gerenciamento de e-mails processados, desenvolvida para armazenar e analisar conteúdo de e-mails recebidos através do SendGrid.

## Índice

- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Configuração](#configuração)
- [Endpoints da API](#endpoints-da-api)
- [Autenticação](#autenticação)
- [Testando a API](#testando-a-api)
- [Contribuição](#contribuição)
- [Licença](#licença)

## Requisitos

- PHP >= 7.4
- Composer
- MySQL ou outro banco de dados suportado
- Laravel 8.x
- SendGrid (para recebimento de e-mails)

## Instalação

1. Clone o repositório:

   ```bash
   git clone https://github.com/**brunofullstack**/EmailProcessor.git
   cd EmailProcessor
   ```

2. Instale as dependências:

   ```bash
   composer install
   ```

3. Copie o arquivo de configuração `.env.example` para `.env`:

   ```bash
   cp .env.example .env
   ```

4. Gere uma chave de aplicação:

   ```bash
   php artisan key:generate
   ```

5. Configure o banco de dados no arquivo `.env`:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nome_do_banco
   DB_USERNAME=seu_usuario
   DB_PASSWORD=sua_senha
   ```

6. Execute as migrações para criar as tabelas necessárias:

   ```bash
   php artisan migrate
   ```

## Configuração

### Configuração do SendGrid

1. Configure o SendGrid para enviar e-mails recebidos para o webhook do seu servidor.

2. No painel do SendGrid, vá para "Settings" > "Mail Settings" > "Inbound Parse".

3. Adicione um domínio e configure o URL do webhook para o seu endpoint de recepção de e-mails.

### Configuração de Autenticação

Este projeto utiliza Laravel Sanctum para autenticação via API. Certifique-se de configurar corretamente os middlewares e o sistema de tokens.

## Endpoints da API

### Autenticação

- **Obter Token**
  - **URL**: `/sanctum/token`
  - **Método**: `POST`
  - **Descrição**: Autentica o usuário e retorna um token de acesso.
  - **Exemplo de Payload**:
    ```json
    {
      "email": "user@example.com",
      "password": "senha_do_usuario",
      "device_name": "nome_do_dispositivo"
    }
    ```

### E-mails

- **Criar E-mail**
  - **URL**: `/emails`
  - **Método**: `POST`
  - **Descrição**: Cria um novo registro de e-mail.
  - **Autenticação**: Bearer Token
  - **Exemplo de Payload**:
    ```json
    {
      "affiliate_id": 1,
      "from": "example@example.com",
      "subject": "Test Subject",
      "email": "Raw email content...",
      "raw_text": "Extracted plain text content..."
    }
    ```

- **Buscar E-mail por ID**
  - **URL**: `/emails/{id}`
  - **Método**: `GET`
  - **Descrição**: Retorna um e-mail específico pelo ID.
  - **Autenticação**: Bearer Token

- **Atualizar E-mail**
  - **URL**: `/emails/{id}`
  - **Método**: `PUT`
  - **Descrição**: Atualiza um e-mail existente pelo ID.
  - **Autenticação**: Bearer Token
  - **Exemplo de Payload**:
    ```json
    {
      "subject": "Updated Subject",
      "raw_text": "Updated plain text content..."
    }
    ```

- **Buscar Todos os E-mails**
  - **URL**: `/emails`
  - **Método**: `GET`
  - **Descrição**: Retorna todos os e-mails.
  - **Autenticação**: Bearer Token

- **Excluir E-mail**
  - **URL**: `/emails/{id}`
  - **Método**: `DELETE`
  - **Descrição**: Exclui um e-mail pelo ID.
  - **Autenticação**: Bearer Token

## Testando a API

### Usando Postman

1. Importe a coleção Postman incluída no projeto (ou veja o exemplo no arquivo de documentação).
2. Configure a variável `base_url` para apontar para o URL base da API.
3. Obtenha um token de autenticação usando o endpoint de autenticação.
4. Adicione o token à variável `token` na coleção Postman para autenticação de endpoints subsequentes.

## Contribuição

Se você deseja contribuir para este projeto, por favor, envie um pull request ou abra uma issue no GitHub.

## Licença

Este projeto é licenciado sob a [Licença MIT](LICENSE).
