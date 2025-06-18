# AirlinesYo

This is a small PHP project used for learning purposes.

## Installation

1. Install dependencies with Composer. This will create the `vendor/` directory:

   ```bash
   composer install
   ```

2. Copy the example database configuration:

   ```bash
   cp config/database.template.php config/database.php
   ```

   Adjust the values in `config/database.php` to match your local setup.

## Running the application

You can use PHP's built‑in server to run the app:

```bash
php -S localhost:8000 -t public
```

The site will then be available at [http://localhost:8000/](http://localhost:8000/).
