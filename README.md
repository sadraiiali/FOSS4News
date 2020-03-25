![FOSS4News_screenshot](/home/thepiker/Projects/FOSS/FOSS4News/doc/img/screenshot.png)

# FOSS4News

Just a simple clone of The Hacker News based on Laravel Framework and Bootstrap4, which is under heavy construction. for now this project just have Farsi/Persian version but we are planning to have other language as soon as possible.

> این صفحه را به فارسی در [اینجا](blob/master/docs/README_FA.md) مشاهده کنید

## Run

before run this project you need to install [php](https://www.php.net/manual/en/install.php), [composer](https://getcomposer.org/), a dbms (like [mysql](https://dev.mysql.com/doc/mysql-installation-excerpt/5.7/en/)) and [npm](https://www.npmjs.com/get-npm).

1. First copy example environment and change it with your parameters.

   `cp .env.example .env`

2. Install PHP dependencies.

    `composer install`

3. Create App Key.

    `php artisan key:generate`

4. Create database tables.

    `php artisan migrate`

5. Link storage files to public.

    `php artisan storage:link`

6. Install JS dependencies.

    `npm install`

7. Run npm.

    `npm run dev` 

8. Run Project using php artisan.

    `php artisan serv`

## License

The main code is licensed under [GPLv3](https://github.com/sadraiiali/FOSS4News/blob/master/LICENSE).

## Contribute

Fill free to clone project, add your code and then submit a pull request. Any participate is willing :)

## Maintainers

- [Alireza Sadraii Rad](https://github.com/sadraiiali/)