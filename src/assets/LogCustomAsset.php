<?php

namespace modava\log\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LogCustomAsset extends AssetBundle
{
    public $sourcePath = '@logweb';
    public $css = [
        'css/customLog.css',
    ];
    public $js = [
        'js/customLog.js'
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_END
    );
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
