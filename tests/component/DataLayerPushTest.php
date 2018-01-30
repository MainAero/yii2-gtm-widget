<?php
namespace mainaero\yii\gtm\component;

use PHPUnit\Framework\TestCase;
use mainaero\yii\gtm\widget\GTM;
use Yii;

class DataLayerPushTest extends TestCase
{
    public function testValuesShouldBeStoredUnderSessionKey()
    {
        $expected = [['event' => 'value']];
        $session = Yii::$app->getSession();

        (new DataLayerPush())->add(['event' => 'value']);

        $actual = $session->get(GTM::SESSION_KEY);
        $this->assertEquals($actual, $expected);
    }

    public function testMultipleValues()
    {
        $expected = [['event' => 'value', 'eventCategory' => 'category']];
        $session = Yii::$app->getSession();

        (new DataLayerPush())->add(['event' => 'value', 'eventCategory' => 'category']);

        $actual = $session->get(GTM::SESSION_KEY);
        $this->assertEquals($actual, $expected);
    }

    public function testExistingSessionValuesShoudlGetMergedWithNewValues()
    {
        $expected = [['old' => 'oldValue'], ['event' => 'value']];
        $session = Yii::$app->getSession();
        $session->set(GTM::SESSION_KEY, [['old' => 'oldValue']]);

        (new DataLayerPush())->add(['event' => 'value']);

        $actual = $session->get(GTM::SESSION_KEY);
        $this->assertEquals($actual, $expected);
    }

    protected function tearDown()
    {
        Yii::$app->getSession()->session = [];
    }
}
