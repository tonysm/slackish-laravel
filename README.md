# Slackish in Laravel

This application is for personal development only. This is just a simplistic version of Slack, the chat service we all know and use.

## Tech

For this application, I'm using:

- [Laravel](https://laravel.com/)
- [VueJS](https://vuejs.org/)
- [Pusher](https://pusher.com/)
- [TailwindCSS](https://tailwindcss.com/)
- [Laravel Socialite](https://laravel.com/docs/5.6/socialite)
- [Laravel Passport](https://laravel.com/docs/5.6/passport)

The internal code I took from Adam Wathan's [Slack Clone](https://tailwindcomponents.com/component/slack-clone-1). 

I know it's not responsive right now, what about sending a PR?

## Setup

If you want to run it locally, here is the setup:

- Clone it
- Copy the `.env.example` to `.env`
- Pull composer dependencies using `composer install'
- Pull npm dependencies using `yarn`
- Build the assets `yarn dev`
- Run `php artisan key:generate`
- Create your database (I use a sqlite file for testing reasons, feel free to use whatever you want)
- Configure the database credentials in the `.env` file
- Run the migrations `php artisan migrate`
- Setup passport `php artisan passport:install`
- Create a Pusher Account and configure the credentials in the `.env` file
- You need to generate [OAuth Application](https://console.developers.google.com/apis/dashboard) and enable the Google Plus contact permission
- After that, configure your `.env` to use those credentials, the redirect URL I use is `http://localhost:8000/auth/google/callback`
- Run the application! (use `php artisan serve`)
