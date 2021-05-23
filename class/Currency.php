<?php

namespace is\Masters\Modules\Isengine;

use is\Helpers\System;
use is\Helpers\Objects;
use is\Helpers\Strings;
use is\Helpers\Local;

use is\Masters\Modules\Master;
use is\Masters\View;

class Currency extends Master {
	
	public function launch() {
		
		$sets = &$this -> settings;
		
		$url = 'http://www.cbr.ru/scripts/XML_daily.asp';
		$data = [];
		
		$folder = $this -> cache;
		$file = $folder . date('Ymd') . '.ini';
		
		Local::createFolder($folder);
		
		if (file_exists($file)) {
			$xmlstr = Local::readFile($file);
		} else {
			$xmlstr = Local::requestUrl($url, null, 'post');
			//$xmlstr = local::openUrl($url);
			if (!empty($xmlstr)) {
				Local::eraseFolder($folder);
				Local::writeFile($file, $xmlstr);
			}
		}
		unset($file, $url);
		
		if (!empty($xmlstr)) {
			$valcurs = new \SimpleXMLElement($xmlstr);
			foreach ($valcurs as $item) {
				$item = (array) $item;
				$val = strtolower($item['CharCode']);
				if (in_array($val, $sets['currencies'])) {
					$data[$val] = ceil(str_replace(',', '.', $item['Value']) * 100) / 100;
				}
				unset($val);
			}
			unset($valcurs, $item, $val);
			$this -> setData($data);
		}
		
		unset($xmlstr);
		
	}
	
}

?>