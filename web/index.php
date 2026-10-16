<?php

defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

require implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'vendor', 'autoload.php']);
require implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'vendor', 'yiisoft', 'yii2', 'Yii.php']);

$config = require implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'config', 'web.php']);

(new yii\web\Application($config))->run();