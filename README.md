# Laravel-5.2 REST API

Required tables

![er-diagram](http://storage9.static.itmages.ru/i/16/0427/h_1461764722_9464696_dc7bfb964b.png "ER Diargam")

## Installation

Copy project to destination folder
`https://github.com/Svyatoy/Laravel-5.2-Controller-test.git`

Import database dump
`rest_lv.sql`

Edit .env to your database connection settings:
```
DB_CONNECTION=your_dbms
DB_HOST=localhost
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Using
####Routes table

| Method | URI | Access | Description |
|--------|-----------------------------------|-----------------------------------------------------------|------------------------------------------------------------------------------|
| POST | api/v1.1/authenticate   | - | User authentication |
| GET | api/v1.1/authenticate/user   | - | Get authenticated user |
| GET | api/v1.1/refresh   | - | Refresh user token |
| GET | api/v1.1/logot   | - | Invalidate user token |
| GET | api/v1.1/albums | Admin only | Get all albums list |
| POST | api/v1.1/albums | User only | Create new album for user |
| GET | api/v1.1/albums/{albums} | Owner, admin, user with permission to see | Get album {album} |
| PUT | api/v1.1/albums/{albums} | Owner, admin, user with permission to change | Update album |
| DELETE | api/v1.1/albums/{albums} | Owner, admin, user with permission to change | Delete album |
| GET | api/v1.1/users | Admin only | Get all users list |
| POST | api/v1.1/users | - | Create new user |
| GET | api/v1.1/users/{users} | User {users} or admin | Get the information about user {users} |
| PUT | api/v1.1/users/{users} | User {users} or admin | Update information about user {users} |
| DELETE | api/v1.1/users/{users} | User {users} or admin | Delete user {users} |
| GET | api/v1.1/users/{users}/albums | User {users} or admin | Get the user {users} albums list |

####Authentication
Authentication using JWT system.

For authentication required `Authorization` header in query heders. Header value must match `Bearer token_value` pattern.

####Authorization
System has 2 types of users:
- admin 
- user

####Thumb Photos edit
To start the scheduler itself, only need to add one cron job on the server (using the crontab -e command), which executes `php /path/to/artisan schedule:run` every minute in the day:
```
* * * * * php /path/to/artisan schedule:run 1>> /dev/null 2>&1
```

## Documentation
For more information see `http://rest-api.com/docs/`
