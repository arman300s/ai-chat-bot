RizzbotChat

RizzBot Chat is a AI chatbot that helps boys to talk with girls. Made with Laravel, OpenAIAPI

Features
User Authentication: Users can log in and log out using Laravel's built-in authentication system.
Chat Interface: Users can send messages to the bot and receive responses.
Clear Chat: Users can clear the chat history with a button click.
Profile Management: Users can edit their profile details.
Before you begin, ensure you have the following installed:

PHP (7.4 or higher)
Composer
Laravel (latest stable version)
SQLite or any other database of your choice (ensure it's configured correctly in your .env file)
Installation
Follow these steps to get the project up and running:

Clone the Repository: 
    git clone https://github.com/your-username/rizzbot-chat.git cd rizzbot-chat 
Install Dependencies: 
    Run Composer to install all necessary Laravel dependencies: composer install

Set Up Environment Variables: 
    Copy the .env.example file to .env: cp .env.example .env 
    Open the .env file and configure your database connection and other necessary environment variables.

Generate Application Key: 
    Run the following command to generate the application key: php artisan key:generate

Migrate the Database: 
    Run the migrations to set up the necessary tables for the application: php artisan migrate

Run the Application: 
    Start the Laravel development server: 
        php artisan serve 
        The application should now be available at http://localhost:8000.
