<?php
namespace Jiny\Template;

use \Jiny\Core\Registry\Registry;

class Liquid
{
    private $View;
    public $Liquid;

    public function __construct($view)
    {
        //echo __CLASS__."객체를 생성합니다.<br>";
        $this->View = $view;


        //$path = __DIR__;
        //echo $path;
        $this->Liquid = new \Liquid\Template();
    }

    public function Liquid($body, $data)
    {
        //echo __METHOD__."<br>";
        // 코드를 추출합니다.
        $this->Liquid->parse($body);

        // 추출한 코드에 데이터를 처리합니다.
        return $this->Liquid->render($data);
    }
}