<?php
namespace mainaero\yii\gtm\stubs;

use yii\web\Session;

class SessionStub extends Session
{
    public $session = [];

    public function get($key, $defaultValue = null)
    {
        return $this->session[$key] ?? null ;
    }

    public function set($key, $value)
    {
        $this->session[$key] = $value;
    }

    public function remove($key)
    {
    }
}
