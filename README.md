# My Larvel and PHP Blog written in Laravel 5.1

Visit the original blog at <a href="http://www.mmarinov.com">mmarinov.com</a>

### Requirements

 - [Laravel 5.1 Compatible environment](http://laravel.com/docs/master#installation)
 - npm, gulp and bower installed
 - ftp server with access to local files
 - mail server
 - running database
 - Registration on [Google reCAPTCHA](https://www.google.com/recaptcha/intro/index.html) and [registered Facebook app](https://developers.facebook.com/) 

### Installation

1) Create a virtual host and a domain to access it(can be with HOSTS file)

2) Create a db for the blog to use

3) Edit the root .env file with the needed configurations:
- app key can be generated with `php artisan key:generate`
- enter the key for google recaptcha in RECAPTCHA_KEY and the id for your facebook app in FB_APP_ID

4) run `php artisan migrate`

5) Remove or replace the google analytics script in resources/views/partials/google_analytics.blade.php

6) Create an admin user. You can use Laravel's user creation by adding a route in routes.php:

```php
Route::get('admin/createAdmin', function(){
    \App\User::create([
        'name' => 'Admin',
        'email'   => 'admin@your.domain',
        'password' => bcrypt(''),
        'is_admin' => 1,
        'is_banned'   => 0,
        'ban_days_left' => 0,
        'is_subscribed' => 0,
    ]);
});
```

If you need to update some of the assets, change them in resources/assets. Then run in terminal `npm install`` and after that `gulp` or asset specific `gulp styles`


### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
