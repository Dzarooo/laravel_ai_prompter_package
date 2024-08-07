# How to config the package

Firstly, make sure you have added provider in `bootstrap/providers.php` as shown below:

```php
//providers.php

return [
    //your providers...
    Dzaro\ImageGenerator\ImageGeneratorProvider::class,
];
```

Before you can use the package, you need to add your ChatGPT API key to the config file. To do this, you need to firstly publish config via terminal:

```
php artisan vendor:publish
```

After that, go to config file (`config/image_generator.php`), find line with GPT_API_KEY and set its value to you API key:
```php
//config/image_generator.php

GPT_API_KEY = { your API key goes here }
```
More informations about how to get ChatGPT API key can be found [there](https://help.openai.com/en/articles/4936850-where-do-i-find-my-openai-api-key)


# How to use the package

Then, to use the package, add these lines of code to your web.php:

```php
//web.php

use Dzaro\ImageGenerator\Controllers\ImageGeneratorController;

Route::get('your_route', [ImageGeneratorController::class, 'show']);
```

...where "your_route" is the route where you want image generator to be.<br>
This route is simply redirecting to blade.php file in which functionality of package can be accessed.