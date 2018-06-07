# YiiMorphy - Yii2 PHPMorphy component

Wrapper for package [maxakawizard/phpmorphy](https://github.com/MAXakaWIZARD/phpmorphy)
and ported to Yii2 component base.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require maxodrom/yii2-phpmorphy:~1.0
```

or add

```
"maxodrom/yii2-phpmorphy": "~1.0"
```

to the require section of your composer.json.



## Usage

Define new component in your Yii2 application config (@app/config/web.php)

```php

$config = [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],  
        'db' => $db,
        /**
         * Set component here!
         */
        'yiimorphy' => [
            'class' => 'maxodrom\phpmorphy\components\YiiMorphy',
            // 'language' => 'ru', // or 'uk', or 'de'
            // 'options' => [], // your options which will be passed to \phpMorphy's constructor 
        ],
    ],
    'modules' => [],
    'params' => $params,
];


```
