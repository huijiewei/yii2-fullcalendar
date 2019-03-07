<?php
/**
 * Created by PhpStorm.
 * User: huijiewei
 * Date: 2019-03-07
 * Time: 11:18
 */

namespace huijiewei\fullcalendar;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

class FullCalendarWidget extends Widget
{
    public $options;
    public $clientOptions;

    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    public function run()
    {
        $this->registerAsset();
        $this->registerScript();

        Html::addCssClass($this->options, 'fullcalendar');

        return Html::tag('div', '', $this->options);
    }

    protected function registerAsset()
    {
        $view = $this->getView();
        $asset = FullCalendarAsset::register($view);

        $asset->registerLanguageJsFile($this->getLanguage());
    }

    protected function getLanguage()
    {
        if (isset($this->clientOptions['lang'])) {
            $language = $this->clientOptions['lang'];
            unset($this->clientOptions['lang']);
        } elseif (isset($this->clientOptions['locale'])) {
            $language = $this->clientOptions['locale'];
        } else {
            $language = \Yii::$app->language;
        }

        $language = strtolower($language);

        return $language;
    }

    protected function registerScript()
    {
        $options = empty($this->clientOptions) ? '' : Json::htmlEncode($this->clientOptions);

        $this->getView()->registerJs("$('#{$this->options['id']}').fullCalendar({$options});");
    }

}