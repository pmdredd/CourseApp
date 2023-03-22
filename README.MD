## Course Management application for UoD GA30003/4 course

The aim of this project is to provide an application lecturers can use to manage Courses, Courseworks, Students and Student Submissions. If you are a 2019 GA30003/4 student,
you can find the full Sprint 1 and 2 requirement specifications in BlackBoard under 'Agile'.

This is a port of the original project to Symfony. The original project was built using plain procedural PHP + PDO and can be found here: https://github.com/Lairdd1989/Uni3rdAGILEProject

## Setting up the project
### Requirements
Make sure you have the following installed:

- PHP 8.2+
  - If you are using windows, I recommend installing [XAMPP](https://www.apachefriends.org/download.html).
- Composer 2.5+
  - This is used to manage the dependencies for the project (e.g. Symfony components, PHPUnit). Installation instructions can be found [here](https://getcomposer.org/download/).
- SQLite3
  - This application uses SQLite3 as the database. You can download it [here](https://www.sqlite.org/download.html).
- Git
  - This is used for version control and is required to get a (development) copy of the project to work on. Any contributions to the project must be made via Git and GitHub.
    It can be downloaded for Windows [here](https://git-scm.com/downloads).
- (Optional) Symfony CLI
  - Helpful tool to run and manage the Symfony application. Get it [here](https://symfony.com/download).
- (Optional) SQLiteBrowser
  - This can be used to view the development sqlite3 database and can be downloaded [here](https://sqlitebrowser.org/dl/).

Development on this app (so far) has been done on Windows. Linux and MacOS requirements/install instructions will  be different.
You should be able to download the required dependencies using your OS's package manager e.g. `apt-get`, `pacman`, `dnf` for Linux, or `brew` for Mac.

### Local setup
If you are already familiar with Git, Composer and Symfony, you can skip to 'Running the project'

#### (Windows)
To get a copy of the source code, navigate to the directory you want to keep the code in (e.g. user/Desktop/code/),
right-click the file explorer window and select 'Git Bash here'. If you do not have this option, please see the 'Git' section of the Requirements.
Alternatively, you can open the directory in cmd or PowerShell.  
Run the following command to get the project code:

`git clone https://github.com/pmdredd/CourseApp.git`

Enter the cloned project's directory:

`cd CourseApp`

To get all of the project's dependencies, run the following command. This will go and get all the packages/libraries required for the project to work correctly:

`composer install`

You will need to set up the .env files for your local development environment. Copy the example .env and .env.test from the root directory of the project, paste them back and
rename them to 'env.local' and 'env.test.local' respectively. You can also do it using these 2 commands if you are using Git Bash:

`cp .env .env.local`

`cp .env.test .env.test.local`

In these files you will put your *personal* configuration details such as database username/passwords.
**These files are not tracked by Git, and you should not allow them to be exposed to the internet.**

If you are using the default SQLite3 database, you do not have to alter these files. If you are instead using MySQL or PostgreSQL then you will need to change the database connection string.
See more info [here](https://symfony.com/doc/current/doctrine.html#configuring-the-database)

### Running the project
#### (Windows)
Once you've set up your database configuration, you can run the database migrations to get a copy of the db schema. Run the following command:

`php bin/console doctrine:migrations:migrate`

(Optional) To populate the database with fake data for testing purposes, run the following command:

`php bin/console doctrine:fixtures:load`

And finally, to run the application, use this command:

`symfony server:start`

Create a new user via the form to log into the application.