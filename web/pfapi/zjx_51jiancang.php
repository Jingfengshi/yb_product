<?php
//error_reporting(E_ERROR|E_WARNING|E_PARSE|E_USER_ERROR|E_USER_WARNING);
ini_set('display_error',0);
error_reporting(0);

if(@function_exists('date_default_timezone_set'))
	@date_default_timezone_set('Asia/Shanghai');
	
if(!isset($_POST['data']))
	die('{"code":"S2","msg":"data is null"}');	
$data=$_POST['data'];			

if($_POST['time']+60*30<time())
	die('{"code":"S2","msg":"[北京时间]服务器时间误差不能超过30分钟"}');	

if(empty($_POST['data']))
	die('{"code":"S2","msg":"data is null"}');	
	
header('Content-Type: text/html; charset=utf-8');
$config['webpath']=dirname(__FILE__)."/";

function get_base_config()
{
	global $config;
	define('BASEPATH','1');
	include($config['webpath'].'../../application/config/config.php');//引入配置文件
	$conf['weburl']=$config['base_url_www'];
	include($config['webpath'].'../../application/config/database.php');//引入数据库配置文件
	$conf['hostname']=$db['default']['hostname'];
	$conf['username']=$db['default']['username'];
	$conf['password']=$db['default']['password'];
	$conf['database']=$db['default']['database'];
	$conf['dbprefix']=!empty($db['default']['dbprefix'])?$db['default']['dbprefix']:'3306'; //端口
	$conf['webpath']=$config['webpath'];
	return $conf;
}

$config=get_base_config();

include($config['webpath'].'../lib/ini_api.php');	
include($config['webpath'].'db.class.php');	

$p_data=authcode($data,'DECODE',0,"zjx_ls".$_POST['sellerid'].$_POST['time'].$_POST['num']);

$data=json_decode($p_data,true);
$db=new dba($config['hostname'],$config['username'],$config['password'],$config['database'],$config['dbprefix']);
$pmemcache=NULL;
$base_lock=NULL;
function get_apiencode($code,$str,$type=0)
{
	global $pmemcache;
	if($type!=0)
	{ 
		if(is_object($pmemcache))
			$pmemcache->order_unlock();
	}
	if($type==2)
		die($str);
	elseif($type==1)
		die('{"code":"'.stripslashes($code).'","msg":"'.stripslashes($str).'"}');
	else
		return '{"code":"'.stripslashes($code).'","msg":"'.stripslashes($str).'"}';
}
$_POST['method'] = preg_replace('#[^a-zA-Z\.]#iuU','',$_POST['method']);
$_POST['method']=trim($_POST['method']);

if(empty($_POST['method'])||!file_exists($config['webpath']."/".$_POST['method']."/index.php"))	
	get_apiencode("S2",$_POST['method'].'方法不存在',1);	
		
if(empty($_POST['time']))	
	get_apiencode("S2","time不能为空",1);
	
if(empty($_POST['num']))	
	get_apiencode("S2","随机数不能为空",1);
	
$ptid=$_POST['sellerid']*1;
if(empty($ptid))
	get_apiencode("S2","渠道不能为空",1);	

$outapi=array('userid'=>2,'passwd'=>'a123456','id'=>2);
if(empty($outapi))
	get_apiencode("S2","渠道不存在",1);	

$sign=md5($_POST['sellerid'].$p_data.$_POST['time'].$_POST['num'].$outapi['passwd']);
unset($p_data);

if(isset($_POST['sign'])&&trim($_POST['sign'])==$sign)
{ 
	@set_time_limit(0); 
	ignore_user_abort(TRUE);
	include_once($config['webpath']."pmemcache.php");
	$pmemcache=new pmemcache(120);
	//--------测试不锁定-------
	$pmemcache->order_unlock($_POST['method'].'_openapi'.$outapi['id']);
	if($pmemcache->order_lock($_POST['method'].'_openapi'.$outapi['id'])===true)
	{
		$lock_name=$_POST['method'].'_openapi';
		include_once($config['webpath']."/".$_POST['method']."/index.php");
		$pmemcache->order_unlock();
	}
	else
		die('{"code":"S2","msg":"系统繁忙"}');
}
else
	die('{"code":"S2","msg":"签名错误1"}');
	
?>