<?php
namespace app\_module\classes\service;

class GitHub extends WebHooks
{
	public function _init()
	{
		// 获取签名、事件类型、装载内容、解码内容	
		$signature = isset($_SERVER['HTTP_X_HUB_SIGNATURE']) ? $_SERVER['HTTP_X_HUB_SIGNATURE'] : '';
		$git_event = isset($_SERVER['HTTP_X_git_event']) ? $_SERVER['HTTP_X_git_event'] : '';
		$payload = isset($_POST['payload']) ? $_POST['payload'] : urldecode(preg_replace('/^payload=/', '', $this->php_input));
		$json = json_decode($payload);
		$full_name = $json->repository->full_name;
		
		// 比较签名、切换事件	
		$hash = "sha1=" . hash_hmac('sha1', $this->php_input, $this->secret);		
		$this->cmp = strcmp($signature, $hash);
		if (0 === $this->cmp) {		
			switch ($git_event) {
				case 'push':
					$this->result = $this->git_pull($full_name);
					break;
				case 'ping':
					break;
				default:
					break;
			}
		}
	}
}