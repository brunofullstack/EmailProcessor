# Successful Emails API

This API manages processed emails, developed to store and analyze email content received through SendGrid.

## Table of Contents

- [Successful Emails API](#successful-emails-api)
  - [Table of Contents](#table-of-contents)
  - [Requirements](#requirements)
  - [Installation](#installation)
  - [Configuration](#configuration)
    - [SendGrid Configuration](#sendgrid-configuration)
    - [Authentication Configuration](#authentication-configuration)
  - [API Endpoints](#api-endpoints)
    - [Authentication](#authentication)
    - [Emails](#emails)
  - [Testing the API](#testing-the-api)
    - [Using Postman](#using-postman)
  - [Contribution](#contribution)
  - [License](#license)

## Requirements

- PHP >= 7.4
- Composer
- MySQL or another supported database
- Laravel 8.x
- SendGrid (for receiving emails)

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/username/repository-name.git
   cd repository-name
   ```

2. Install the dependencies:

   ```bash
   composer install
   ```

3. Copy the configuration file `.env.example` to `.env`:

   ```bash
   cp .env.example .env
   ```

4. Generate an application key:

   ```bash
   php artisan key:generate
   ```

5. Configure the database in the `.env` file:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. Run the migrations to create the necessary tables:

   ```bash
   php artisan migrate
   ```

## Configuration

### SendGrid Configuration

1. Set up SendGrid to forward received emails to your server's webhook.

2. In the SendGrid dashboard, go to "Settings" > "Mail Settings" > "Inbound Parse".

3. Add a domain and set the webhook URL to your email receiving endpoint.

### Authentication Configuration

This project uses Laravel Sanctum for API authentication. Make sure to properly configure the middleware and token system.

## API Endpoints

### Authentication

- **Obtain Token**
  - **URL**: `/sanctum/token`
  - **Method**: `POST`
  - **Description**: Authenticates the user and returns an access token.
  - **Example Payload**:
    ```json
    {
      "email": "user@example.com",
      "password": "user_password",
      "device_name": "device_name"
    }
    ```

### Emails

- **Create Email**
  - **URL**: `/emails`
  - **Method**: `POST`
  - **Description**: Creates a new email record.
  - **Authentication**: Bearer Token
  - **Example Payload**:
    ```json
    {
      "affiliate_id": 1,
      "from": "example@example.com",
      "subject": "Test Subject",
      "email": "Raw email content...",
      "raw_text": "Extracted plain text content..."
    }
    ```

- **Get Email by ID**
  - **URL**: `/emails/{id}`
  - **Method**: `GET`
  - **Description**: Retrieves a specific email by ID.
  - **Authentication**: Bearer Token

- **Update Email**
  - **URL**: `/emails/{id}`
  - **Method**: `PUT`
  - **Description**: Updates an existing email by ID.
  - **Authentication**: Bearer Token
  - **Example Payload**:
    ```json
    {
      "subject": "Updated Subject",
      "raw_text": "Updated plain text content..."
    }
    ```

- **Get All Emails**
  - **URL**: `/emails`
  - **Method**: `GET`
  - **Description**: Retrieves all emails.
  - **Authentication**: Bearer Token

- **Delete Email**
  - **URL**: `/emails/{id}`
  - **Method**: `DELETE`
  - **Description**: Deletes an email by ID.
  - **Authentication**: Bearer Token

## Testing the API

### Using Postman

1. Import the Postman collection included in the project (or refer to the example in the documentation file).
2. Set the `base_url` variable to point to the API's base URL.
3. Obtain an authentication token using the authentication endpoint.
4. Add the token to the `token` variable in the Postman collection for subsequent endpoint authentication.

## Contribution

If you want to contribute to this project, please submit a pull request or open an issue on GitHub.

## License

This project is licensed under the [MIT License](LICENSE).

---

Feel free to adjust the `README.md` as needed to better fit the specifics of your project.