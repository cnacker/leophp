<?php
namespace app\_module\classes\service;

class WebHooks
{
	protected $php_input = null;
	protected $secret = 'bunny';
	public $cmp = true;
	public $result = null;
	
	public function __construct()
	{
		$this->php_input = file_get_contents('php://input');
		$this->_init();
	}
	
	/**
	 * 拉取
	 */
	public function git_pull($full_name)
	{
		$filename = realpath(APP_PATH . "/../docs/{$full_name}_pull.bat");
		# $command = file_get_contents($filename);
		$command = <<<HEREDOC
start $filename
HEREDOC;
		$last_line = exec($command, $output, $return_var);
		return get_defined_vars();
	}
}
