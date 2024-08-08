# How to config the package

Firstly place package in given directory: `packages/Dzaro/ImageGenerator`.<br>
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

After that, go to config file (`config/image_generator.php`), find line with OPENAI_API_KEY and set its value to you API key:
```php
//config/image_generator.php

OPENAI_API_KEY = { your API key goes here }
```
More informations about how to get OpenAI API key can be found [there](https://help.openai.com/en/articles/4936850-where-do-i-find-my-openai-api-key)


# How to use the package

After properly configuring the package, you have 2 new already configured routes to use:
- `/text_generator`,
- `/image_generator`

Use them as you wish!