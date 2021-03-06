Installation Instructions:

Please check the official laravel installation guide for server requirements before you start. https://laravel.com/docs/7.x
Install all dependencies or follow the homestead installation.
Once you have ther server requirements met, go to the folder where you want to install the app.

Clone the repository

`git clone https://github.com/phillipeastman/file_manager.git`

Switch to the repo folder

`cd file_manager`

Install all the dependencies using composer

`composer install`

Copy the example env file and make the required configuration changes in the .env file

`cp .env.example .env`

Generate a new application key

`php artisan key:generate`

Run the database migrations (Set the database connection in .env before migrating)

`php artisan migrate`

Setup the symlink so the public files can be access through url

`php artisan storage:link`

Start the local development server

`php artisan serve`

Edit your etc hosts file
Depending on how you set this up, you may need to add dns routing, or modify the etc hosts file, or even change the angular baseURL in the filemanager-api service to match your configuration.  I set my hosts file to: 

`192.168.10.10   filemanager-api.test`

since I was using the homestead vagrant virtual machine, and that was it's default ip.
