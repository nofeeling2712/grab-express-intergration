# gservice

> Support curl 
## Installation
in command line:  
`$ composer require gservice/gservice`

## How to use
Add `\GExpress\GService\Providers\GServiceProvider::class` in `config/app.php`  
Update middleware with `\GExpress\GService\Middleware\GServiceMiddleware::class` in `app/Http/kernel.php`  
Please run the command below to public the config package and you can change some value for the project.  
`php artisan vendor:publish --provider="GExpress\GService\Providers\GServiceProvider"`
You can custom with `.env` file some value. Add new route in `api.php`, something like this.
```php
Route::post('gservice/accesstoken', function () {
     $gservice = new \GExpress\GService\GService();
     $gservice->getNewAccessToken();
 });
```
don't forget add `\Illuminate\Session\Middleware\StartSession::class` to `$middleware` in `app/Http/kernel.php`
If you call route above, a new access token will be generated and stored in session have name `access_token`. You can create a new request with method `get`, `post`, `put`, `delete`.  
`get`: `get($url, $data = [], $headers = [])`  
`post`: `post($url, $data = [], $headers = [], $contentType = '', $files = [], $isJson = true)`  
`put`: `put($url, $data = [], $headers = [])`  
`delete`: `delete($url, $data = [], $headers = [])`  
example: 
```php
    $gservice = new \GExpress\GService\GService();
    $headers = ['Cache-Control' => 'no-cache'];
    $gservice->post($url, $data, $headers, 'application/json', [], true)
```
