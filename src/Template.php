<?php
namespace Jiny\Template;

use \Jiny\Core\Registry\Registry;

/**
 * jiny 
 * 템플릿 처리
 * Liquid, Blade, Carpet
 */
class Template
{
    private $View;
    public $Liquid;

    public function __construct($view)
    {
        // \TimeLog::set(__CLASS__."가 생성이 되었습니다.");

        // 의존성 주입
        // View 클래스의 인스턴스르 저장합니다.
        $this->View = $view;
        
        // 템플릿을 처리하여 뷰의 _body에 저장합니다.
        $this->View->_body = $this->template($this->View->_body);
    }

    // 템플릿을 처리합니다.
    public function template($body)
    {
        // \TimeLog::set(__METHOD__);
        // 템플릿 엔진에 따라서 동작을 처리합니다.
        switch ($this->isEngine()) {
            // Liquid 템플릿 엔진처리
            case 'Liquid':
                $this->Liquid = new \Jiny\Template\Liquid($this->View);
                
                return $this->Liquid->Liquid(
                    $body, 
                    $this->View->view_data
                );

            default:
        }
      
        return $body;
    }

    public function isEngine()
    {
        return "Liquid";
    }
}