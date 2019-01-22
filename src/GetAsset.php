<?php
/**
 * GetAsset plugin for Craft CMS 3.x
 *
 *
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

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function(Event $event) {
            /** @var CraftVariable $variable */
            $variable = $event->sender;
            $variable->set('getasset', GetAssetVariable::class);
        });
    }

    protected function createSettingsModel()
    {
        return new \youandmedigital\getasset\models\Settings();
    }

}
