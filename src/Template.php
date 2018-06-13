<?php
namespace Jiny\Template;

use \Jiny\Core\Registry\Registry;
//use Liquid\Template;

class Template
{
    private $View;
    public $Liquid;

    public function __construct($view)
    {
        //echo __CLASS__."객체를 생성합니다.<br>";
        $this->View = $view;
        $this->View->_body = $this->template($this->View->_body);
    }

    // 템플릿을 처리합니다.
    public function template($body)
    {
        // echo __METHOD__."를 호출합니다.<br>";

        // echo "<pre>";
        // print_r($this->View->_data);
        // echo "</pre>";

        switch ($this->isEngine()) {
            case 'Liquid':
                //echo "Liquid를 적용합니다.<br>";
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