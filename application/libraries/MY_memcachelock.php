<?php
defined('APPPATH') or die('Access restricted!'); 
class  MY_memcachelock
{
	public $memcache;
    public $tm;
    public function __construct()
	{
		$this->tm       = 60;
		$this->memcache = memcache_connect('127.0.0.1', 11211) or die('服务繁忙');
	}
	
	//刷新锁定时间
	public function flush_lock($lock_name)
	{
		$f=md5($lock_name.'_lock');
		memcache_set($this->memcache,$f,1,0,$this->tm); 
	}
	
	//锁定
	public function lock($lock_name)
	{
		$f=md5($lock_name.'_lock');
		$num=0;
		//过期时间30秒
		if(memcache_add($this->memcache,$f,1, FALSE,$this->tm))
			return true;
		else
			return false;
	}
	
	//解锁
	public function unlock($shopuid)
	{
		$f=md5($shopuid.'_lock');
		memcache_delete($this->memcache,$f,0);
	}
}


?>