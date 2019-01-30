<?php
namespace app\_module\classes\service;

class WebHooks
{
	protected $php_input = null;
	protected $secret = null;
	public $cmp = true;
	public $result = null;
	public $same_names = ['devops-env/dev'];
	
	public function __construct()
	{
		$this->php_input = file_get_contents('php://input');
		# $this->php_input = '{"repository": {"full_name": "wudi/cdn"} }';
		$this->secret = $GLOBALS['_CONFIG']['git']['webhook_secret'];
		$this->_init();
	}
	
	/**
	 * 拉取
	 */
	public function git_pull($full_name, $branch = '', $site = '')
	{
		$branch_path = '';
		if ($branch && 'master' != $branch) {
			$branch_path = '_' . $branch;
		}

		// 解决同名
		$suffix = '';
		if ($site && in_array($full_name, $this->same_names)) {
			$suffix = '.' . $site;
		}
		
		// 适应 Windows 中文
		$full_name = mb_convert_encoding($full_name, 'GBK', 'UTF-8');
		$filename = APP_PATH . "/../docs/{$full_name}{$branch_path}_pull$suffix.bat";
		$realpath = realpath($filename);
		# echo $realpath = mb_convert_encoding($realpath, 'UTF-8', 'GBK');exit;
		# $command = file_get_contents($filename);
		$command = <<<HEREDOC
start $realpath
HEREDOC;
		$last_line = exec($command, $output, $return_var);
		return get_defined_vars();
	}
}
