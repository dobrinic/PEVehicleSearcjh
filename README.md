# Parts Europe Search

## Download
##### On your local machine navigate to folder where you want to install this project.
##### Open terminal in that location and paste following line to download project.
```shell
git clone https://github.com/dobrinic/PEVehicleSearcjh.git
```
##### Create database in MySql
```shell
CREATE DATABASE name_here;
```

## Installation
**Navigate to newly created directory**
```shell
$ cd PEVehicleSearcjh
```

**Install the Package Via Composer:**
```shell
$ composer install
```

**Create ENV file:**
```shell
Rename .env.example to .env
```

**Generate App Key:**
```shell
$ php artisan key:generate
```

**Setup ENV file:**
```shell
Add all relevant data like database name, database user, database password
```

**Run migrations:**
```shell
$ php artisan migrate
```

#### Import data:
Run next two commands to populate the database with Excel and CSV data.
**Alternatively you can skip this step and import data through application form.**
```shell
$ php artisan import:vehicles
```
```shell
$ php artisan import:parts
```

**Start server:**
```shell
$ php artisan serve
```

After you start server type http://localhost:8000 to your browser

**If you need to empty all database tables for testing purposes run:**
```shell
$ php artisan migrate:fresh
```

