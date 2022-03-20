# Author's Post

This is web base application for post sharing.
User can create account and add post. Any other can see this post and also can comment on it.

## Installation

Import repository from GitHUB, use below command

```bash
git clone https://github.com/chandevishal/authors-post.git
```

## Tech stack used

Laravel 8

PHP 8

MySQL Database

JavaScript/jQuery

HTML/CSS

laravel/ui auth 3.4(for authentication)

## Project setup guidelines

First clone project and place it into your root directory

Install Vendor folder using below command

```bash
composer install
```

Create a new database in your local MySQL with the name "post_author"

```bash
CREATE DATABASE `post_author`;
```

Set Database and Email credentials in the .env file

```bash
DB_CONNECTION=mysql
DB_HOST=<databse host>
DB_PORT=3306
DB_DATABASE=post_author
DB_USERNAME=<user name>
DB_PASSWORD=<password>
```

```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=<gamil id>
MAIL_PASSWORD=<account password>
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=<from email id>
MAIL_FROM_NAME="${APP_NAME}"
```

After adding DB credentials run the migration to create all required tables in your DB.

```bash
php artisan migrate
```

Now create some dummy data by using seeders. Run below command

```bash
php artisan db:seed
```

## Usage

Open new terminal, navigate to project directory, and serve project using PHP artisan command

```bash
php artisan serve
```

### list all post
http://127.0.0.1:8000/posts

### create new post
http://127.0.0.1:8000/posts/create

### show specific post
http://127.0.0.1:8000/posts/{id}

### edit post
http://127.0.0.1:8000/posts/{id}/edit

## Development story

I required almost one day to complete this whole task.

All functionality that is asked I delivered into this project. Nothing is pending.

