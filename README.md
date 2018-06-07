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

In your code you can use component via standard way:

```php

/** @var \phpMorphy $morphy */
$morphy = Yii::$app->yiimorphy->morphy;

$word_one = 'КОТ';
$word_two = 'СОБАКА';

try {
	// word by word processing
	// each function return array with result or FALSE when no form(s) for given word found(or predicted)
	$base_form = $morphy->getBaseForm($word_one);
	$all_forms = $morphy->getAllForms($word_one);
	$pseudo_root = $morphy->getPseudoRoot($word_one);

	if(false === $base_form || false === $all_forms || false === $pseudo_root) {
		die("Can`t find or predict $word_one word");
	}

	echo 'base form = ' . implode(', ', $base_form) . "\n";
	echo 'all forms = ' . implode(', ', $all_forms) . "\n";

	echo "Testing bulk mode...\n";

	// bulk mode speed-ups processing up to 50-100%(mainly for getBaseForm method)
	// in bulk mode all function always return array
	$bulk_words = array($word_one, $word_two);
	$base_form = $morphy->getBaseForm($bulk_words);
	$all_forms = $morphy->getAllForms($bulk_words);
	$pseudo_root = $morphy->getPseudoRoot($bulk_words);

	// Bulk result format:
	// array(
	//   INPUT_WORD1 => array(OUTWORD1, OUTWORD2, ... etc)
	//   INPUT_WORD2 => FALSE <-- when no form for word found(or predicted)
	// )
	echo 'bulk mode base form = ' . implode(', ', $base_form[$word_one]) . ' ' . implode(', ', $base_form[$word_two]) . "\n";
	echo 'bulk mode all forms = ' . implode(', ', $all_forms[$word_one]) . ' ' . implode(', ', $all_forms[$word_two]) . "\n";

	// You can also retrieve all word forms with graminfo via getAllFormsWithGramInfo method call
	// $all_forms_with_gram = $morphy->getAllFormsWithGramInfo($word_one);

	exit;
} catch(\phpMorphy_Exception $e) {
	die('Error occured while text processing: ' . $e->getMessage());
}


```
