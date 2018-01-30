<?php
namespace mainaero\yii\gtm\component;

use yii\base\component;
use mainaero\yii\gtm\widget\GTM;
use Yii;

class DataLayerPush extends Component
{
    public function add(array $event) : void
    {
        $session = Yii::$app->getSession();
        $values = $session->get(GTM::SESSION_KEY) ?? [];
        $values[] = $event;
        $session->set(
          GTM::SESSION_KEY,
          $values
        );
    }
}
