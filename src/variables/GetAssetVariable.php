<?php

/**
 * GetAsset plugin for Craft CMS 3.x
 *
 *
 * @link      https://github.com/youandmedigital/craft-getasset
 * @copyright Copyright (c) 2019 You & Me Digital
 */

namespace youandmedigital\getasset\variables;
use youandmedigital\getasset\GetAsset;
use Symfony\Component\Finder\Finder;
class GetAssetVariable
{
    /**
     * Main GetAsset template variable.
     *
     * @param string $filePath
     * @param string $filePattern
     *
     * @return string
     */

    public function options($filePath, $filePattern = '*'): string
    {
        if ($filePath !== '') {
            // get webroot path
            $fullPath = \Yii::getAlias(GetAsset::getInstance()->getSettings()->publicRoot ?? '@webroot');

            // process options...
            $path = $fullPath . $filePath;
            $pattern = $filePattern;

            // start new finder instance
            $finder = new Finder();

            // filter results based on some options
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

            // return output
            return $output;
        }

        // otherwise return nothing
        return '';

    }


}
