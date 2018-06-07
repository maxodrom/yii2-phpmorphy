<?php
/**
 * Yii2 PHPMorphy project.
 *
 * @author Max Alexandrov <max@7u3.ru>
 * @link https://github.com/maxodrom/yii2-phpmorphy
 * @copyright Copyright (c) Max Alexandrov, 2018
 */

namespace maxodrom\phpmorphy\components;

use yii\base\Component;
use yii\base\InvalidArgumentException;
use yii\helpers\ArrayHelper;

/**
 * Class Morphy
 * @package maxodrom\phpmorphy\components
 */
class YiiMorphy extends Component
{
    /**
     * @var \phpMorphy phpMorphy instance
     */
    public $morphy;
    /**
     * @var string Language, default is 'ru'.
     */
    public $language = 'ru';
    /**
     * @var array Options for phpMorphy constructor
     */
    public $options = [
        'storage' => \phpMorphy_Storage_Factory::STORAGE_FILE,
    ];
    /**
     * @var array Available dictionaries
     */
    private static $dictionaries = [
        'ru' => 'ru_RU',
        'de' => 'de_DE',
        'uk' => 'uk_UA',
    ];

    /**
     * Morphy constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);

        if (!in_array($this->language, array_keys(self::$dictionaries))) {
            throw new InvalidArgumentException(
                '$language param must be one of the following: ' . implode(', ', array_keys(self::$dictionaries))
            );
        }
        $options = ArrayHelper::merge($this->options, $this->options);
        $this->morphy = new \phpMorphy(null, self::$dictionaries[$this->language], $options);
    }
}