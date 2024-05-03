Description:
This project is a PHP-based web application that requires a MySQL database. Follow the instructions below to set up the project environment and run it using PHP's built-in web server.

Setup Instructions:

1. Configure Database Connection:
   - Open the file config/db.php.
   - Replace the placeholder values with your actual database credentials.
   - Save the file.

   Example config/db.php:

   <?php

   define('DB_HOST', 'localhost');
   define('DB_USER', 'your_database_username');
   define('DB_PASSWORD', 'your_database_password');
   define('DB_NAME', 'your_database_name');

   ?>

2. Import Database Schema:
   - Execute the provided SQL script (db.sql) on your MySQL database.
   - This script will create the necessary tables and schema required for the application.

3. Start PHP Built-in Web Server:
   - Open your terminal or command prompt.
   - Navigate to the root directory of your project.
   - Run the following command to start PHP's built-in web server:

     ```
     php -S 127.0.0.1:8000
     ```

   - This command will start the server and bind it to localhost on port 8000.

4. Access the Application:
   - Open your web browser.
   - Navigate to http://localhost:8000 to access the application.

Additional Notes:
- Ensure that PHP is installed on your system and added to your system's PATH environment variable.
- Make sure that the necessary PHP extensions/modules are installed and enabled.
- Always sanitize and validate user input to prevent security vulnerabilities such as SQL injection.
- Regularly backup your database to prevent data loss.



