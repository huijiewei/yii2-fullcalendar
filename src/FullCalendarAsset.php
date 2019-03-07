<?php
/**
 * Created by PhpStorm.
 * User: huijiewei
 * Date: 2018/8/16
 * Time: 21:36
 */

namespace huijiewei\fullcalendar;

use yii\web\AssetBundle;

class FullCalendarAsset extends AssetBundle
{
    public $sourcePath = '@npm/fullcalendar/dist';

    public $css = [
        'fullcalendar.min.css',
    ];

    public $js = [
        'fullcalendar.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'huijiewei\moment\MomentAsset',
    ];

    public function registerLanguageJsFile($lang)
    {
        $langAsset = 'locale/' . $lang . '.js';

        if (file_exists(\Yii::getAlias($this->sourcePath . DIRECTORY_SEPARATOR . $langAsset))) {
            $this->js[] = $langAsset;
        }
    }
}
