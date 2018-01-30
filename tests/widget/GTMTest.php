<?php
namespace mainaero\yii\gtm\widget;

use PHPUnit\Framework\TestCase;
use yii\base\View;
use mainaero\yii\gtm\stubs\ViewStub;
use Yii;
use yii\log\Logger;

final class GTMTest extends TestCase
{
    protected $widget;
    protected $renderer;

    public function testShouldReturnRenderedNoScriptSnippet()
    {
        Yii::$app->params = [
        'gtm_env' => '&gtm_auth=<TOKEN>w&gtm_preview=<ENV_ID>&gtm_cookies_win=x',
        'gtm_id' => '1A2B3CD'
      ];
        $this->assertEquals(
          $this->renderer->renderPhpFile(
            'src/widget/views/noscript.php',
            [
              'gtm_env' => '&gtm_auth=<TOKEN>w&gtm_preview=<ENV_ID>&gtm_cookies_win=x',
              'gtm_id' => '1A2B3CD'
            ]
          ),
          $this->widget::widget(['type' => 'noscript'])
      );
    }

    public function testTypeShouldBeDefaultScript()
    {
        $this->widget::widget();
        $this->assertEquals('script', $this->widget->type);
    }

    public function testShouldReturnRenderedJavaScriptSnippet()
    {
        Yii::$app->params = [
          'gtm_env' => '&gtm_auth=<TOKEN>w&gtm_preview=<ENV_ID>&gtm_cookies_win=x',
          'gtm_id' => '1A2B3CD'
        ];
        $this->assertEquals(
            $this->renderer->renderPhpFile(
              'src/widget/views/script.php',
              [
                'gtm_env' => '&gtm_auth=<TOKEN>w&gtm_preview=<ENV_ID>&gtm_cookies_win=x',
                'gtm_id' => '1A2B3CD'
              ]
            ),
            $this->widget::widget()
        );
    }

    public function testShouldReturnRenderedJavaScriptSnippetWithEmptyEnv()
    {
        Yii::$app->params = [
        'gtm_id' => '1A2B3CD'
      ];
        $this->assertEquals(
          $this->renderer->renderPhpFile(
            'src/widget/views/script.php',
            [
              'gtm_env' => '',
              'gtm_id' => '1A2B3CD'
            ]
          ),
          $this->widget->widget()
      );
    }

    public function testShouldReturnRenderedDataPushSnippet()
    {
        $dataLayerPushItems = [['event' => 'eventValue']];
        $session = Yii::$app->getSession();
        $session->set('gtm-data-layer-push', $dataLayerPushItems);

        $this->assertEquals(
        $this->renderer->renderPhpFile(
          'src/widget/views/dataLayerPush.php',
          [
            'dataLayerPushItems' => $dataLayerPushItems
          ]
        ),
        GTM::widget(['type' => 'dataLayerPush'])
      );
    }

    public function testShouldReturnEmptyStringIfNoDataLayerPushItems()
    {
        $this->assertEquals('', GTM::widget(['type' => 'dataLayerPush']));
    }

    public function testShouldReturnEmptyStringIfIdParamNotSet()
    {
        Yii::$app->params = ['gtm_env' => 'forgot to set gtm_id'];
        $this->assertEquals('', $this->widget->run());
    }

    protected function setUp()
    {
        $this->renderer = new View();
        $this->widget = new GTM();
        $this->widget->setView(new ViewStub());
    }

    protected function tearDown()
    {
        unset($this->renderer);
        unset($this->widget);
        Yii::$app->params = [];
        Yii::getLogger()->messages = [];
        Yii::$app->getSession()->session = [];
    }
}
