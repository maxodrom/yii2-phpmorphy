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
use yii\helpers\ArrayHelper;

/**
 * Class Morphy
 * @package maxodrom\phpmorphy\components
 */
class YiiMorphy extends Component
{
    /**
     * @var \phpMorphy
     */
    public $morphy;
    /**
     * @var string
     */
    public $language = 'ru_ru';
    /**
     * @var array Options for phpMorphy constructor
     */
    public $options = [
        'storage' => \phpMorphy_Storage_Factory::STORAGE_FILE,
    ];

    /**
     * Morphy constructor.
     * @param string $language
     * @param array $options
     * @param array $config
     */
    public function __construct($language = 'ru', array $options = [], array $config = [])
    {
        $options = ArrayHelper::merge($this->options, $options);
        $this->morphy = new \phpMorphy(null, $this->language, $options);

        parent::__construct($config);
    }
}