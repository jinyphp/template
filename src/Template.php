<?php
namespace Jiny\Template;

use \Jiny\Core\Registry\Registry;

/**
 * jiny 
 * 템플릿 처리
 * Liquid, Blade, Carpet
 */
class Template Extends Engine
{
    private $View;
    private $App;
    public $Processor;

    public function __construct($view)
    {
        // \TimeLog::set(__CLASS__."가 생성이 되었습니다.");

        // 의존성 주입
        // View 클래스의 인스턴스르 저장합니다.
        $this->View = $view;
        $this->App = $view->App;

        // 기본 템플릿 동작
        // 카페트
        //$Carpet = new \Jiny\Template\Carpet\Carpet();
        //$this->View->_body = $Carpet->parser($this->View->_body);


/*
        // 사용자 템플릿 엔진 적용
        // 템플릿을 처리하여 뷰의 _body에 저장합니다.
        $this->View->_body = $this->process($this->View->_body);
        */

    }

    // 템플릿을 처리합니다.
    public function process($body)
    {
        // \TimeLog::set(__METHOD__);
        // 템플릿 엔진에 따라서 동작을 처리합니다.
        switch ($this->isEngine()) {
            // Liquid 템플릿 엔진처리
            case 'Liquid':
                $this->Processor = new \Jiny\Template\Adapter\Liquid($this->View);
                       
                return $this->Processor->Liquid($body, $this->View->_data);

            default:
        }
      
        return $body;
    }

    /**
     * 
     */
}