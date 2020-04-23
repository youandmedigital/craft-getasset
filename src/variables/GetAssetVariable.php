<?php
/**
 * GetAsset plugin for Craft CMS 3.1
 *
 * This little plugin looks in a certain folder for a file 
 * that was last modified and returns the value in Twig.
 *
 * @author    You & Me Digital
 * @link      https://github.com/youandmedigital/craft-getfiles
 * @copyright Copyright (c) 2019 You & Me Digital
 */

namespace youandmedigital\getasset\variables;

use youandmedigital\getasset\GetAsset;
use Craft;

class GetAssetVariable
{

    public function config($settings = null)
    {
        return GetAsset::$plugin->getAssetService->list($settings);
    }

}
