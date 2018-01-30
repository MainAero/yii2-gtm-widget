<?php
namespace mainaero\yii\gtm\component;

use yii\base\component;
use mainaero\yii\gtm\widget\GTM;
use Yii;

class DataLayerPush extends Component
{
    public function add(String $key, String $value) : void
    {
        $session = Yii::$app->getSession(GTM::SESSION_KEY);
        $session->set(
          GTM::SESSION_KEY,
          array_merge($session->get(GTM::SESSION_KEY) ?? [], [[$key => $value]])
        );
    }
}
