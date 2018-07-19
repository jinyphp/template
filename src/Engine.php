<?php
namespace Jiny\Template;

use \Jiny\Core\Registry\Registry;

class Engine
{
    private $_engine;

    /**
     * 템플릿 엔진을 확인합니다.
     */
    public function isEngine()
    {
        return "Liquid";
    }

    /**
     * 템플릿 엔진을 설정합니다.
     */
    public function setEngine($engine)
    {
        $this->_engine = $engine;
    }

}