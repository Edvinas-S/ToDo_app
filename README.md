# ToDo app

## This was for education only :see_no_evil: :hear_no_evil: :speak_no_evil:  

### Used: 
- [x] Laravel 8.x;
- [x] Laratrust;
- [x] Bootstrap CSS;
- [x] MySQL;

There are two types of users: **Admin** and simple **users**.\
As Admin you can: C.R.U.D. all users and create task for users.\
As User you only can change the status of the task(ToDo, InProgress, Done).\

The app picture:\
![Image of App](https://github.com/Edvinas-S/todo_app/blob/master/public/app.jpg)

### You can start it like this: 
- Download zip project and unzip it;
- Go inside project folder and start CLI (like Git Bash );
- Run commands:
1. For install PHP packages:
```
composer install
```
2. For NPM packages:
```
npm install
```
3. Make a copy of the .env.example file and create a .env file:
```
cp .env.example .env
```
4. Generate an app encryption key:
```
php artisan key:generate
```
- Create database with a few fake users with SQL dump file located in `root/DB dump` folder.
- In the .env file fill in the `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.
5. run:
```
php artisan serve
```
- In your browser go to http://localhost:8000/

> Login as Administrator
>email: **admin@app.com**
>password: **password**

- :eyes:

> P.S. you need PHP and Composer installed globaly in your windows machine and local server (e.g. AMPPS) running

#### Author [Edvinas](https://github.com/Edvinas-S)
