<?php
namespace mainaero\yii\gtm\stubs;

use yii\web\Application;

class ApplicationStub extends Application
{
    public $session;

    public function get($id, $throwException = true)
    {
      if ($id == 'session')
        return $this->session ?? $this->session = new SessionStub();
      return parent::get($id, $throwException);
    }
}
