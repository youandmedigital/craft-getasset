<?php

namespace youandmedigital\getasset\variables;
use youandmedigital\getasset\GetAsset;
use Symfony\Component\Finder\Finder;
class GetAssetVariable
{
    /**
     * Main GetAsset template variable.
     *
     * @param string $filePath
     *
     * @return string
     */
    public function options($filePath): string
    {
        // get webroot path
        $fullPath = \Yii::getAlias(GetAsset::getInstance()->getSettings()->publicRoot ?? '@webroot');

        // join webroot and filePath
        $path = $fullPath . $filePath;

        $finder = new Finder();
        $finder
            ->files()
            ->in($path)
            ->name('/^(c).min.*\S{10}.css$/')
            ->depth('== 0')
            ;
        $finder
            ->sortByModifiedTime();

        foreach ($finder as $file) {
            $output = $file->getFileName();
        }

        return $output;


    }


}
