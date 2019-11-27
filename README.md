# Course Management application for UoD GA30003/4 course

The aim of this project is to provide an application lecturers can use to manage Courses, Courseworks, Students and Student Submissions. If you are a 2019 GA30003/4 student,
you can find the full Sprint 1 and 2 requirement specifications in BlackBoard under 'Agile'.  

This is a port of the original project to Symfony 4.4. The original project was built using plain procedural PHP + PDO and can be found here: https://github.com/Lairdd1989/Uni3rdAGILEProject  

## Setting up the project
### Requirements
Make sure you have the following installed:

- PHP 7.2+
    - If you are using windows, I recommend installing [XAMPP](https://www.apachefriends.org/download.html)
- Composer 1.9+
    - This is used to manage the dependencies for the project (e.g. Symfony components, PHPUnit). Installation instructions can be found [here](https://getcomposer.org/download/)
- Yarn 1.19 +
    - This is used to manage and compile the frontend assets (css/js). Download instructions [here](https://yarnpkg.com/en/docs/install) 
- Git
    - This is used for version control and is required to get a (development) copy of the project to work on. Any contributions to the project must be made via Git and GitHub.
      It can be downloaded for Windows [here](https://git-scm.com/downloads)
- Symfony installer
    - Required to run and manage the Symfony application. Not strictly required, but extremely helpful and recommended. Get it [here](https://symfony.com/download)
- (Optional) SQLiteBrowser
    - This can be used to view the development sqlite3 database and can be downloaded [here](https://sqlitebrowser.org/dl/)
- (Optional) DBeaver Community Edition
    - If you choose to use MySQL or PostgreSQL instead of the default SQLite3 db, you can use DBeaver to view the database. See more info and download from [here](https://dbeaver.io/)    

### Local setup
If you are already familliar with Git, Composer and Symfony, you can skip to 'Running the project'
#### (Windows)
To get a copy of the source code, navigate to the directory you want to keep the code in (e.g. user/Desktop/code/), 
right-click the file explorer window and select 'Git Bash here'. If you do not have this option, please see the 'Git' section of the Requirements.
Alternatively, you can open the directory in PowerShell.  
Run the following command to get the project code:

`git clone https://github.com/pmdredd/CourseApp.git`

To get all of the project's dependencies, run the following command. This will go and get all the packages/libraries required for the project to work correctly:

`composer install`

You will need to set up the .env files for your local development environment. Copy the example .env and .env.test from the root directory of the project, paste them back and
rename them to 'env.local' and 'env.test.local' respectively. You can do it using these 2 commands if you are using Git Bash:

`cp .env .env.local`

`cp .env.test .env.test.local`

In these files you will put your *personal* configuration details such as database username/passwords. 
These files are not tracked by Git, and you should not allow them to be exposed to the internet.

If you are using the default SQLite3 database, you do not have to alter these files. If you are instead using MySQL or PostgreSQL then you will need to change the database connection string.
See more info [here](https://symfony.com/doc/current/doctrine.html#configuring-the-database)
 
To get all the frontend dependencies, run the following command:
`yarn install`

And to compile all the frontend files for development, run this command:
`yarn encore dev`

### Running the project
#### (Windows)
Once you've set up your database configuration, you can run the database migrations to get a copy of the db schema. Run the following command:

`php bin/console doctrine:migrations:migrate`

(Optional) To populate the database with fake data for testing purposes, run the following command:

`php bin/console doctrine:fixtures:load`
 
 And finally, to run the application, use this command:
 
 `php bin/console server:run`

