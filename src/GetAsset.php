<?php
/**
 * GetAsset plugin for Craft CMS 3.1
 *
 * This little plugin looks in a certain folder for a file 
 * that was last modified and returns the value in Twig.
 *
 * @author    You & Me Digital
 * @link      https://github.com/youandmedigital/craft-getasset
 * @copyright Copyright (c) 2019 You & Me Digital
 */

namespace youandmedigital\getasset;

use craft\base\Plugin;
use youandmedigital\getasset\variables\GetAssetVariable;
use craft\web\twig\variables\CraftVariable;
use yii\base\Event;

class GetAsset extends Plugin
{

    public static $plugin;
    public $schemaVersion = '1.0.0';

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function(Event $event) {
                $variable = $event->sender;
                $variable->set('getasset', GetAssetVariable::class);
            }
        );
    }

}
