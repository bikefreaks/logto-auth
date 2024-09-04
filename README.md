# This is my package logto-auth

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bikefreaks/logto-auth.svg?style=flat-square)](https://packagist.org/packages/bikefreaks/logto-auth)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/bikefreaks/logto-auth/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/bikefreaks/logto-auth/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/bikefreaks/logto-auth/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/bikefreaks/logto-auth/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/bikefreaks/logto-auth.svg?style=flat-square)](https://packagist.org/packages/bikefreaks/logto-auth)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require bikefreaks/logto-auth
```
You can publish the config file with:

```bash
php artisan vendor:publish --tag="logto-auth-config"
```

This is the contents of the published config file:

```php
return [
    'endpoint' => env('LOG_TO_ENDPOINT'),
    'app_id' => env('LOG_TO_APP_ID'),
    'app_secret' => env('LOG_TO_APP_SECRET'),
    'lee_way' => env('LOG_TO_LEE_WAY', 15),
];
```
## Usage

```php
// app/Policies/AppServiceProvider.php
      use BeraniDigital\LibraryLaravelLogtoIo\Facades\LibraryLaravelLogtoIo;
    public function register(): void
    {
        
        LibraryLaravelLogtoIo::config()->scopes = [
            \Logto\Sdk\Constants\UserScope::profile,
            \Logto\Sdk\Constants\UserScope::email,
            \Logto\Sdk\Constants\UserScope::phone,
            \Logto\Sdk\Constants\UserScope::identities,
            \Logto\Sdk\Constants\UserScope::roles,
        ];
        LibraryLaravelLogtoIo::config()->resources = [
          // add your resources here
        ];
    }
```

```php
// routes/web.php
Route::get('/callback', function () {
    try {
        \bikefreaks\LogtoAuth\Facades\LogtoAuth::handleSignInCallback();
    }catch (\Logto\Sdk\LogtoException $e){
        return redirect()->route('login')->with('error', $e->getMessage());
    }
    $logToUser = \bikefreaks\LogtoAuth\Facades\LogtoAuth::fetchUserInfo();
    $user = \App\Models\User::where(config('logto-auth.user_id_field'), $logToUser->sub)->first();
    if(!$user){
        $user = new \App\Models\User;
        $user->logto_id = $logToUser->sub;
        $faker = \Faker\Factory::create();
        $user->name = $logToUser->name ?? $logToUser->username ?? $logToUser->email ?? $faker->numerify('User ####');
    }
    // always fetch latest user's email and phone number after login
    if(config('logto-auth.save_phone')) {
    $user->phone = $logToUser->phone_number;
    }
    
    $user->email = $logToUser->email;
    $user->email_verified_at = $logToUser->email_verified ? now() : null;
    $user->save();

    \Illuminate\Support\Facades\Auth::login($user);
    return redirect()->route('home');
})->name('auth.callback');

Route::get('/login', function () {
    return redirect(bikefreaks\LogtoAuth\Facades\LogtoAuth::signIn(route('auth.callback')));
})->name('login');

function logout() {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect(bikefreaks\LogtoAuth\Facades\LogtoAuth::signOut(route('home')));
}
Route::get('/logout', function () {
    return logout();
})->name('logout');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Willi Helwig](https://github.com/aldrahastur)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
