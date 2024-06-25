## Application Run Guide

### Prerequisites

Ensure you have [PHP](https://www.php.net/), [Composer](https://getcomposer.org/), and [Node.js](https://nodejs.org/) installed on your machine.

### Setup Instructions

1. **Configure Environment Variables:**
   - Copy the `.env.example` file to `.env`.
   - Configure the database connection settings in the `.env` file.

2. **Install Dependencies:**
   - For PHP dependencies, run:
     ```sh
     composer install
     ```
   - For frontend dependencies, run:
     ```sh
     npm install
     ```
3. **Seed the DB**
    To seed courses:
   ```sh
   php artisan db:seed --class=CoursesTableSeeder
   ```

4. **Start the Application:**
   To launch the application, run:
   ```sh
   php artisan serve
   ```
   The URL for accessing the admin interface will be displayed in the CLI output.

### Accessing the Admin Interface

- Open the provided URL in your web browser to explore the admin interface.
- API Endpoints for frontend will be found here [API](https://documenter.getpostman.com/view/8119126/2sA3XY6y9D)

### Notes

- Ensure your `.env` file is correctly set up with all necessary configurations.