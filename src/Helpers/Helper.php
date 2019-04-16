<?php
/*
 * This file is part of the jinyPHP package.
 *
 * (c) hojinlee <infohojin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

 namespace Jiny;

use \Jiny\Template\Adapter\Liquid;
use \Jiny\Template\Template;

/**
 * 템플릿을 실행합니다.
 */
if (! function_exists('template')) {
	function template($engine, $html) {
		if (func_num_args()) {
			$func = "\jiny\\".$engine;
			return $func($html->_body, $html->_data);
		} else {
			// return Template::instance();
		}
	}
}

/**
 * 리퀴드 템플릿을 실행합니다.
 */
if (! function_exists('liquid')) {
    function liquid($body, $data = [], $path=null) {
		$obj = Liquid::instance();

		if (func_num_args()) {
			if ($path) {
				$obj->setPath($path);
			} else {
				$obj->initPath();
			}			
			$obj->factory();
			return $obj->render($body, $data);
		} else {
			return $obj;
		}
	}
}