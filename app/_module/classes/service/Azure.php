<?php
namespace app\_module\classes\service;

class Azure extends WebHooks
{
	public function _init()
	{
		// 获取签名、事件类型、装载内容、解码内容	
		$signature = isset($_SERVER['HTTP_X_AZURE_SIGNATURE']) ? $_SERVER['HTTP_X_AZURE_SIGNATURE'] : '';		
		$payload =  $this->php_input ? : (isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '');
		$json = json_decode($payload);
		$full_name = $json->resource->repository->name;
		$remoteUrl = $json->resource->repository->remoteUrl;
		$git_event = $json->eventType;

		if (preg_match('/^https:\/\/([a-z0-9\-]+)\.visualstudio\.com\/(.*)/i', $remoteUrl, $matches)) {
			$user = $matches[1];
			$full_name = $user .'/'. $full_name;
		}
		
		// 比较签名、切换事件	
		$this->cmp = strcmp($signature, $this->secret);
		if (0 === $this->cmp) {		
			switch ($git_event) {
				case 'git.push':
					$this->result = $this->git_pull($full_name);
					break;
				case 'ping':
					break;
				default:
			}
		}
	}
}
