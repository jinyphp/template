<?php
namespace Jiny\Template\Adapter;

use \Jiny\Core\Registry\Registry;

class Liquid
{
    private $View;
    public $Liquid;

    public function __construct($view)
    {
        // \TimeLog::set(__CLASS__."가 생성이 되었습니다.");

        // 의존성 주입
        // View 클래스의 인스턴스르 저장합니다.
        $this->View = $view;

        // 패티지 liquid/liquid
        // 인스턴스를 생성합니다.
        // $path = $this->View->Controller->Application->Config->data("ENV.path.view");
        $path = ROOTPATH.Registry::get("CONFIG")->data("ENV.path.pages");
        $path = str_replace("/",DS,$path);
        //echo $path ."<br>";
        
        \Liquid\Liquid::set('INCLUDE_ALLOW_EXT', true);
        $this->Liquid = new \Liquid\Template($path);
        // $this->Liquid->setCache(new Local());
    }

    /**
     * Liquid 랜더링을 처리합니다.
     */
    public function Liquid($body, $data)
    {
        // \TimeLog::set(__METHOD__);
        
        // 코드를 추출합니다.
        $this->Liquid->parse($body);

        // 추출한 코드에 데이터를 처리합니다.
        return $this->Liquid->render($data);
    }

}