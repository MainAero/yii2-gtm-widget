<?php
namespace mainaero\yii\widget;

use yii\base\Widget;
use Yii;

class GTM extends Widget
{
    const PARAM_ENV = 'gtm_env';
    const PARAM_ID = 'gtm_id';

    const TYPE_SCRIPT = 'script';
    const TYPE_NOSCRIPT = 'noscript';

    public $type = '';

    public function init()
    {
        parent::init();
        if ($this->type != self::TYPE_SCRIPT && $this->type != self::TYPE_NOSCRIPT)
          $this->type = self::TYPE_SCRIPT;
    }

    public function run()
    {
        $params = $this->getParams();
        if ($this->paramMissing($params)) {
            return '';
        }
        return $this->render($this->type, $params);
    }

    private function paramMissing(array $params) : bool
    {
        if (empty($params[self::PARAM_ID])) {
            Yii::warning('Param "' . self::PARAM_ID . '" not set.');
            return true;
        }
        return false;
    }

    private function getParams() : array
    {
        return [
          self::PARAM_ENV => Yii::$app->params[self::PARAM_ENV] ?? '',
          self::PARAM_ID => Yii::$app->params[self::PARAM_ID] ?? ''
        ];
    }
}
