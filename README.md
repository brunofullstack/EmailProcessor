```markdown
# Successful Emails API

This is the API for managing processed emails, developed to store and analyze email content received through SendGrid.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Email Processing](#email-processing)
- [API Endpoints](#api-endpoints)
- [Authentication](#authentication)
- [Testing the API](#testing-the-api)
- [Contribution](#contribution)
- [License](#license)

## Requirements

- PHP >= 7.4
- Composer
- MySQL or another supported database
- Laravel 8.x

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/brunofullstack/EmailProcessor.git
   cd EmailProcessor
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
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. Run the migrations to create the necessary tables:

   ```bash
   php artisan migrate
   ```

## Configuration

### Authentication Configuration

This project uses Laravel Sanctum for API authentication. Make sure to properly configure the middleware and token system.

## Email Processing

To process and extract the plain text from emails stored in the database, you can use the Artisan command `emails:process`. This command fetches all emails that have not yet had their plain text extracted (where `raw_text` is null) and performs the extraction and storage of the plain text.

### Running the Command

To process the emails, run the following command in the terminal:

```bash
php artisan emails:process
```

### How It Works

1. **Fetching Emails:** The command retrieves all emails from the `successful_emails` table where the `raw_text` field is null.
2. **Extracting Plain Text:** It uses the `\PhpMimeMailParser\Parser` library to parse the raw email content and extract the plain text.
3. **Database Update:** The extracted plain text is saved in the `raw_text` field of the corresponding email in the database.
4. **Notification:** A message is displayed in the terminal indicating that the emails have been successfully processed.

## API Endpoints

### Authentication

- **Get Token**
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
  - **Description**: Returns a specific email by ID.
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
  - **Description**: Returns all emails.
  - **Authentication**: Bearer Token

- **Delete Email**
  - **URL**: `/emails/{id}`
  - **Method**: `DELETE`
  - **Description**: Deletes an email by ID.
  - **Authentication**: Bearer Token

## Testing the API

### Using Postman

1. Import the Postman collection included in the project (or see the example in the documentation file).
2. Set the `base_url` variable to point to the API base URL.
3. Obtain an authentication token using the authentication endpoint.
4. Add the token to the `token` variable in the Postman collection for authentication of subsequent endpoints.

## Contribution

If you wish to contribute to this project, please submit a pull request or open an issue on GitHub.

## License

This project is licensed under the [MIT License](LICENSE).
```