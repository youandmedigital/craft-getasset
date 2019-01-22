<?php

namespace youandmedigital\getasset\variables;
use youandmedigital\getasset\GetAsset;
class GetAssetVariable
{
    /**
     * Main GetAsset template variable.
     *
     * @param string $fileName
     * @param string $mode
     *
     * @return string
     */
    public function options($filePath, $mode = 'file'): string
    {

        // accept file beginning with 's'
        // followed by .min.
        // followed by any 10 digit hash
        // ending in js
        $cleanJs = '/^(s).min.*\S{10}.js$/';

        // accept files beginning with 'c' or 'ie'
        // followed by .min.
        // followed by any 10 digit hash
        // ending in css
        $cleanCss = '/^(c).min.*\S{10}.css$/';
        $cleanCssIe = '/^(ie).min.*\S{10}.css$/';

        // return an array of results based on folder path
        $assetArrayCss = preg_grep($cleanCss, scandir('.' . $filePath));
        $assetArrayJs = preg_grep($cleanJs, scandir('.' . $filePath));
        $assetArrayCssIe = preg_grep($cleanCssIe, scandir('.' . $filePath));
        $assetArrayCssSortby = array();
        $assetArrayCssIeSortby = array();
        $assetArrayJsSortby = array();

        // for each css asset in the folder...
        foreach ($assetArrayCss as $value) {
            // get timestamp
            $lastModified = filemtime( '.' . $filePath . '/' . $value);
            // add timestamp to new array
            $assetArrayCssSortby[] = array(
                'asset' => $value,
                'timestamp' => $lastModified
            );
        }

        // for each css asset in the folder...
        foreach ($assetArrayCssIe as $value) {
            // get timestamp
            $lastModified = filemtime( '.' . $filePath . '/' . $value);
            // add timestamp to new array
            $assetArrayCssIeSortby[] = array(
                'asset' => $value,
                'timestamp' => $lastModified
            );
        }

        // for each css asset in the folder...
        foreach ($assetArrayJs as $value) {
            // get timestamp
            $lastModified = filemtime( '.' . $filePath . '/' . $value);
            // add timestamp to new array
            $assetArrayJsSortby[] = array(
                'asset' => $value,
                'timestamp' => $lastModified
            );
        }

        usort($assetArrayCssSortby, function ($a, $b) {
            return $b["timestamp"] - $a["timestamp"];
        });

        usort($assetArrayCssIeSortby, function ($a, $b) {
            return $b["timestamp"] - $a["timestamp"];
        });

        usort($assetArrayJsSortby, function ($a, $b) {
            return $b["timestamp"] - $a["timestamp"];
        });

        // take the first result in the array
        $latestCss = reset($assetArrayCssSortby);
        $latestCssIe = reset($assetArrayCssIeSortby);
        $latestJs = reset($assetArrayJsSortby);

        // take value from asset key (the filename);
        $css = $latestCss['asset'];
        $ie = $latestCssIe['asset'];
        $js = $latestJs['asset'];

        // if file path is not empty...
        if ($filePath !== '') {

            // if css mode selected...
            if ($mode === 'css') {
                return $css;
            }

            // if css mode selected...
            if ($mode === 'cssie') {
                return $ie;
            }

            // if css mode selected...
            if ($mode === 'js') {
                return $js;
            }

            // otherwise return nothing
            return '';
        }
    }

}
