# Phoenix Music

## Requirements

Before you proceed make sure your server meets the following requirements:

- [Composer](https://getcomposer.org/)
- [Yarn](https://yarnpkg.com/) or [NPM](https://www.npmjs.com/)
- [PHP](https://php.net/) >= 7.0
- MySQL Database

## Installation

##### 1. Clone the git repository

    git clone https://github.com/EpicArrow/phoenix_music.git
   
##### 2. Run the following command from the command line in the project root to install the composer packages:
    
    composer install

##### 3. Run the following command from the command line in the project root to install the npm packages:
 
    yarn
   
   _or_
    
    npm

##### 4. Run the following command from the command line in the project root to link the `storage/app/public` folder to `public/storage`:

    php artisan storage:link
    
##### 5. Create a database.
##### 6. Copy the contents of `.env.example` and create a new file called `.env` in the project root. Set your application variables in the new file. Be sure to keep the value of `APP_ENV` set to `local` for the duration of the install.
##### 7. Run the following command from the command line in the project root and follow the on-screen prompts:

    php artisan portfolio:install

##### 8. Run the following command from the command line in the project root to change the permissions of the `storage/` directory.

    chmod -R 777 storage/
