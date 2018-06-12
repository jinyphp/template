<?php
namespace Jiny\Template;

use \Jiny\Core\Registry\Registry;
//use Liquid\Template;

class Liquid
{
    private $View;
    public $Liquid;

    public function __construct($view)
    {
        echo __CLASS__."객체를 생성합니다.<br>";
        $this->View = $view;

        $this->$Liquid = new \Liquid\Template();
    }

    public function Liquid($body, $data)
    {
        echo __METHOD__."<br>";
        echo "Liquid 템플릿을 처리합니다.<br>";
        $this->$Liquid->parse($body);

        echo "<pre>";
        $data['name'] = "jiny";
        print_r($data);
        echo "</pre>";

        return $this->$Liquid->render($data);
    }
}