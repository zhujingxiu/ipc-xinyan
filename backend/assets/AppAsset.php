<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'adminlte/dist/css/font-awesome.min.css',
        'adminlte/dist/css/AdminLTE.min.css',
    ];
    public $js = [
        'adminlte/dist/js/app.min.js',

    ];
    public $depends = [

        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**
     * @var string|bool Choose skin color, eg. `'skin-blue'` or set `false` to disable skin loading
     * @see https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html#layout
     */
    public $skin = '_all-skins';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    /**
     * @inheritdoc
     */
    public function init()
    {
        // Append skin color file if specified
        if ($this->skin) {
            if (('_all-skins' !== $this->skin) && (strpos($this->skin, 'skin-') !== 0)) {
                throw new Exception('Invalid skin specified');
            }

            $this->css[] = sprintf('adminlte/dist/css/skins/%s.min.css', $this->skin);
        }

        parent::init();
    }
}
