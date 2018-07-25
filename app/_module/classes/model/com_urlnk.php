<?php
namespace app\_default\class\model;

class com_urlnk extends \Mr\Model
{
	public function init()
	{
		$this->config = [
			'server' => '127.0.0.1:3306',
			'user' => 'root',
			'pass' => 'root',
		];
	}
}
