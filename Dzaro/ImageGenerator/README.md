# How to use the package

Firstly, add these lines of code to your web.php:

```php
//web.php

use Dzaro\ImageGenerator\Controllers\ImageGeneratorController;

Route::get('your_route', [ImageGeneratorController::class, 'show']);
```

where "your_route" is the route where you want image generator to be