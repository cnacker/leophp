<?php
namespace Mr;

class Template
{
	public $layout = null;
	public $content = null;
	public $exec = [];
	
	public function __construct()
	{
		$this->init();
	}
	
	public function init($config = [])
	{
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->uri = $_SERVER['REQUEST_URI'];
	}
	
	public function getMethod()
	{
	}
	
	public function render($file, $data = [])
	{
		$this->exec[] = $file;
		# print_r($this->exec);
		if (3 < count($this->exec)) {
			
			exit;
		}
		
		$out2 = '';
		$file = APP_PATH . '/_module/theme/' . $file . '.php';
		extract($data);
		ob_start();
		$include = include_once $file;
		
		if (is_bool($include) || is_int($include)) {
			$out2 = ob_get_contents();
			
		// 返回内容
		} else {
			$out2 = $include;
		}
		
		ob_end_clean();
		
		if ($this->layout) {			
			$this->content = $out2;
			if (is_array($this->layout)) {
				$file = $this->layout[0];
				$data = isset($this->layout[1]) ? $this->layout[1] : $data;
			} else {
				$file = $this->layout;
			}
			$this->layout = null;
			$out2 = $this->render($file, $data);
		}
		return $out2;
	}
	
	public function content()
	{
		return $this->content;
	}
	
	public function __destruct()
	{
	}
}
	