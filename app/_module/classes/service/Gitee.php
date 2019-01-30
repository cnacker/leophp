<?php
namespace app\_module\classes\service;

class Gitee extends WebHooks
{
	public function _init()
	{
		// 获取签名、事件类型、装载内容、解码内容	
		$signature = isset($_SERVER['HTTP_X_GITEE_TOKEN']) ? $_SERVER['HTTP_X_GITEE_TOKEN'] : '';
		$git_event = isset($_SERVER['HTTP_X_GITEE_EVENT']) ? $_SERVER['HTTP_X_GITEE_EVENT'] : '';
		$payload =  $this->php_input ? : (isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '');
		$json = json_decode($payload);
		$full_name = $json->repository->full_name;
		
		// 比较签名、切换事件	
		$this->cmp = strcmp($signature, $this->secret);
		if (0 === $this->cmp) {		
			switch ($git_event) {
				case 'Push Hook':
					$this->result = $this->git_pull($full_name, '', 'gitee');
					break;
				case 'ping':
					break;
				default:
			}
		}
	}
}
