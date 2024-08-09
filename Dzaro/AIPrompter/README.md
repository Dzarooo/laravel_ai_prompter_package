# How to configure the package

_Note: Package was created on Laravel 11 and this tutorial follows Laravel 11. Configuration steps may vary depending on Laravel version and package may not work properly on older versions._

Firstly place package in given directory: `packages/Dzaro/AIPrompter`.

then, go to composer.json and add this block of code to your repositories section:

```php
//composer.json

"repositories": [
    {
        "type": "path",
        "url": "packages/Dzaro/AIPrompter",
        "options": {
            "symlink": true
        }
    }
]
```

and this to "require" section:

```php
//composer.json

"require": [
    "dzaro/ai_prompter": "dev-main"
]
```

if you want, you can place the package anywhere you want, but remember to change "url" attribute in repositories' object.

then, run in terminal of your project following command:

```
composer install
```

To be sure that package has installed, you can also run this command (not necessary):

```
composer update dzaro/ai_prompter
```

After that, make sure you have added provider in `bootstrap/providers.php` as shown below:

```php
//providers.php

return [
    //your providers...
    Dzaro\AIPrompter\providers\AIPrompterProvider::class,
];
```

Before you can use the package, you need to add your OpenAI API key to the config file. To do this, you need to firstly publish config via terminal of your project:

```
php artisan vendor:publish
```

After that, go to config file (`config/aiprompter.php`), find line with `openai_api_key` and set its value to you API key:
```php
//config/aiprompter.php

openai_api_key = { your API key goes here }
```
More informations about how to get OpenAI API key can be found [here](https://help.openai.com/en/articles/4936850-where-do-i-find-my-openai-api-key)


# How to use the package

After properly configuring the package, you have 2 new already configured routes to use:
- `/text_generator`,
- `/image_generator`

Use them as you wish!