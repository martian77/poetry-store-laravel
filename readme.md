# Poetry Store

This project is designed to allow a user to store copies of poems.

It is supposed to act like a personal poetry store, and not as a way to share these poems with other people.

It is also designed to explore [Laravel](/readme-laravel.md).

## Versions
Please note this is currently running Laravel 5.8.

## Local setup

(I may have forgotten something!)

- Get the code locally.
- Run `composer install`. (This either needs composer installed locally or globally.)
- Create a local blank database. Probably UTF8.
- Make a copy of the .env.example called .env and set the database details in there.
- Generate the application key with `php artisan key:generate`.
- Run `php artisan migrate --seed` to get the database tables with some dummy content.
- To compile the js and css you'll need to run npm. Probably need to start with a `npm install`. **You should only need to do this if you make changes to them!**
