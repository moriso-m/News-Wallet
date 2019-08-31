# News-Wallet
This is a an API that can be used to save articles read online and helps you to organize your articles by grouping them according to their category.
This aAPI has been built using Laravel framework and uses Laravel passport for authentication and authorization

***Setting up the API***
Install laravel passport which will be required for authentication. Navigate to your folder on the terminal and run the command below

``composer require laravel/passport``

The rest of the configuration have been setup
Migrate models Configure your database and then Run the following commands:

``php artisan migrate``

Create the encryption keys needed to generate secure access tokens. 

``php artisan passport:install``

Other configurations have been done

Now start the server

``php artisan serve``

***You can now use postman to test various URLs, Follow the link below to view the API documentation***

**https://documenter.getpostman.com/view/7485362/SVfRt8C8**
