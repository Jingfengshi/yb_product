<?php

if(!isset($config['webpath']))
{
	header("location:404.php");
	die;
}

/*
cmd.exe以管理员 
windows
5>cd C:\memcached（回车） 
6>memcached -d start(回车)可以关闭此cmd窗口。 
此时可以使用新配置的memcache服务器了。 
上述方法虽然解决了修改默认配置的问题，但是始终会有一个cmd窗口不可以关闭，否则就回到11211端口的默认配置。 
更好的解决方案是通过修改服务的注册表配置： 
1>开始>运行：regedit(回车) 
2>在注册表中找到：HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Services\memcached Server 
3>默认的ImagePath键的值是："c:\memcached\memcached.exe" -d runservice，改为："c:\memcached\memcached.exe" -d runservice -m 20 -p 11211 -l 192.168.1.55（确定，关闭注册表） 

*/
class  pmemcache
{
	public $memcache='';
    public $tm;
	public $lock_name;
	
    public function pmemcache($tm=30)
	{ 
		$tm*=1;
		if(!empty($tm))
			$this->tm    = $tm;
		else
			$this->tm    = 30;	
		$this->memcache='';
	}
	
	public function get_memcache()
	{
		$de=memcache_connect('127.0.0.1', 11211);
		if(empty($de))
		{
			echo '服务繁忙';
			die;
		}
		return $de;
	}
	
	//刷新锁定时间
	public function flush_lock($lock_name='')
	{
		if(empty($this->memcache))
			$this->memcache=$this->get_memcache();
		$this->lock_name=empty($lock_name)?$this->lock_name:$lock_name;
		$f=md5($this->lock_name.'_lock');
		@memcache_set($this->memcache,$f,1,0,$this->tm); 
	}
	
	//锁定
	public function order_lock($lock_name='',$tm=0)
	{
		if(empty($this->memcache))
			$this->memcache=$this->get_memcache();
		$this->lock_name=empty($lock_name)?$this->lock_name:$lock_name;
		$f=md5($this->lock_name.'_lock');
		$num=0;
		
		//过期时间30秒
		if(@memcache_add($this->memcache,$f,1, FALSE,$tm*1>0?$tm*1:$this->tm)===true)
			$flag=true;
		else
			$flag=false;
		return $flag;
	}
	
	//解锁  $times 延迟时间 
	public function order_unlock($lock_name='',$times=0)
	{
		if(empty($this->memcache))
			$this->memcache=$this->get_memcache();
		$flag=false;	
		$this->lock_name=empty($lock_name)?$this->lock_name:$lock_name;
		$f=md5($this->lock_name.'_lock');
		if(@memcache_delete($this->memcache,$f,$times))
			$flag=true;
		return $flag;	
	}
	
	//查询
	public function get($lock_name='')
	{
		if(empty($this->memcache))
			$this->memcache=$this->get_memcache();
		$this->lock_name=empty($lock_name)?$this->lock_name:$lock_name;
		$f=md5($this->lock_name.'_lock');	
		$de=@memcache_get($this->memcache,$f); 
		return  $de;	
	}	
	
	//关闭
	public function close()
	{
		if(!empty($this->memcache))
		{
			memcache_close($this->memcache);
			$this->memcache='';
		}
	}	
}


?>