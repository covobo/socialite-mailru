# MailRu OAuth2 Provider for Laravel Socialite

## Difference with jhaoda/socialite-mailru

The package jhaoda/socialite-mailru supports only legacy mailru OAuth2 based on connect.mail.ru authentification.

This package works with actual mailru OAuth2 based on oauth.mail.ru.

## Package details

This package does not support additional mailru security feature "state". Package uses adhoc solution to pass mailru validation.  

## Installation

### 1. Setup your application on mail.ru

See details here https://oauth.mail.ru/app/

### 2. Install package

`composer require covobo/socialite-mailru`

### 3. Service Provider

* Remove `Laravel\Socialite\SocialiteServiceProvider` from your `providers[]` array in `config\app.php` if you have added it already.
* Add `SocialiteProviders\Manager\ServiceProvider` to your `providers[]` array in `config\app.php`.

For example:
```php
'providers' => [
    // a whole bunch of providers
    // remove 'Laravel\Socialite\SocialiteServiceProvider',
    SocialiteProviders\Manager\ServiceProvider::class, // add
];
```
* Note: If you would like to use the Socialite Facade, you need to [install it](http://laravel.com/docs/5.2/authentication#social-authentication).

### 4. Add the Event and Listeners

* Add `SocialiteProviders\Manager\SocialiteWasCalled::class` event to your `listen[]` array in `<app_name>/Providers/EventServiceProvider`.

* Add your listeners (i.e. the ones from the providers) to the `SocialiteProviders\Manager\SocialiteWasCalled[]` that you just created.

* The listener that you add for this provider is `Covobo\SocialiteProviders\MailRu\MailRuExtendSocialite::class`.

* Note: You do not need to add anything for the built-in socialite providers unless you override them with your own providers.

For example:
```php
/**
 * The event handler mappings for the application.
 *
 * @var array
 */
protected $listen = [
    SocialiteProviders\Manager\SocialiteWasCalled::class => [
        Covobo\SocialiteProviders\MailRu\MailRuExtendSocialite::class
    ],
];
```

### 5. Services Array and .env

Add to `config/services.php`:
```php
'mailru' => [
    'client_id' => env('MAILRU_CLIENT_ID'),
    'client_secret' => env('MAILRU_CLIENT_SECRET'),
    'redirect' => env('MAILRU_REDIRECT'),  
],
```

Append provider values to your `.env` file:
```
// other values above
MAILRU_CLIENT_ID=application_id
MAILRU_CLIENT_SECRET=application_secret
MAILRU_REDIRECT=https://yoursite.com/callback
```
