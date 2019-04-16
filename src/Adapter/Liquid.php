<?php
/*
 * This file is part of the jinyPHP package.
 *
 * (c) hojinlee <infohojin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Jiny\Template\Adapter;

use \Jiny\Core\Registry\Registry;
/**
 * 어뎁터 패턴
 * liquid/liquid 페키지로 결합합니다.
 */
class Liquid
{
    private $View;

    public function setView($view)
    {
        $this->View = $view;
    }
    
    /**
     * 인스턴스
     */
    private static $Instance;

    /**
     * 싱글턴 인스턴스를 생성합니다.
     */
    public static function instance()
    {
        if (!isset(self::$Instance)) {
            // 자기 자신의 인스턴스를 생성합니다.                
            self::$Instance = new self();

            return self::$Instance;
        } else {
            // 인스턴스가 중복
            return self::$Instance; 
        }
    }

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    private $path=null;
    /**
     * 레이아웃 결합을 위한 기본 루트 경로를 설정합니다.
     */
    public function initPath($path=".")
    {
        if(defined("ROOTPATH")) {
            $path = ROOTPATH.Registry::get("CONFIG")->data("ENV.path.pages");
        }        
        $this->path = str_replace("/", DS, $path);
        return $this;
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public $Liquid;
    /**
     * 인스턴스를 생성합니다.
     */
    public function factory()
    {
        if (!isset($this->Liquid)) {
            
            // 테그변경, liquid 4.0
            $this->initTags();

            // 인스턴스를 생성합니다.
            $this->Liquid = new \Liquid\Template($this->path);
        } 
        
        return $this; 
    }

    private function initTags()
    {
        \Liquid\Liquid::set('INCLUDE_ALLOW_EXT', true);

        \Liquid\Liquid::$config['TAG_START'] = "{%-";
        \Liquid\Liquid::$config['TAG_END'] = "-%}";

        \Liquid\Liquid::$config['VARIABLE_START'] = "{{-";
        \Liquid\Liquid::$config['VARIABLE_END'] = "-}}";

        return $this;
    }

    /**
     * Liquid 랜더링을 처리합니다.
     */
    public function render($body, $data)
    {        
        // Liquid 코드를 추출합니다.
        $this->Liquid->parse($body);

        // 추출한 코드에 데이터를 처리합니다.
        return $this->Liquid->render($data);
    }

    /**
     * 
     */
}