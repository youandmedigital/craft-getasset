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

namespace youandmedigital\getasset\services;

use youandmedigital\getasset\GetAsset;
use Symfony\Component\Finder\Finder;
use Craft;
use craft\base\Component;

class GetAssetService extends Component
{

    public function list($settings): string
    {

        $filePath = $settings['path'] ?? '';
        $filePattern = $settings['pattern'] ?? '*';

        if ($filePath !== '') {

            // get webroot path
            $fullPath = \Yii::getAlias(GetAsset::getInstance()->getSettings()->publicRoot ?? '@webroot');

            // set output
            $output = '';

            // process options...
            $path = $fullPath . $filePath;
            $pattern = $filePattern;

            // start new finder instance
            $finder = new Finder();

            // filter results
            // https://symfony.com/doc/current/components/finder.html

            $finder
                ->files()
                ->in($path)
                ->name($filePattern)
                ->depth('== 0');
            $finder
                ->sortByModifiedTime();

            // for each result, set output to filename
            foreach ($finder as $file) {
                $output = $file->getFileName();
            }

            return $output;

        }

        // otherwise return nothing
        return '';

    }

}
