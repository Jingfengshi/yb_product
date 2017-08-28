<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logistics extends MY_Controller {
    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
		$this->load->model('Base_Logistics_model');
	}

	//运费模板列表
	public function logistics_list()
	{
		if(!empty($_GET['act']))
		{
			$this->logistics_check();
		}

		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql='';
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('status','id');
			//姓名模糊查询字段
			$search_key_ar_more=array('name');
			foreach($_GET as $k=>$v)
			{
				$skey=substr($k,7,strlen($k)-7);
				if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
				{
					//非模糊查询
					if(in_array($skey,$search_key_ar))
						$wsql.=" and {$skey}='{$v}'";
					//模糊查询
					if(in_array($skey,$search_key_ar_more))
						$wsql.=" and {$skey} like '%{$v}%'";
				}
			}
		}
		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$this->load->model('Base_page_model');
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows =$this->Base_page_model
				->where($wsql)
				->select_one('a.*',tab_m('logistics_temp_con_show')." as a ")
				->num_rows();
		}

		$res=array();
		$de=$this->Base_page_model
			->where($wsql)
			->select_one("a.*,if(b.company!='',b.company,c.company) as com
			,if(b.logistics_temp_id_ls!='','零售','批发') as c_type,if(b.id!='',b.id,c.id) as warehouse_id "
			,tab_m('logistics_temp_con_show')." as a ")
			->left_join(tab_m('stock_warehouse')." as b ",'a.temp_id=b.logistics_temp_id_ls')
			->left_join(tab_m('stock_warehouse')." as c ",'a.temp_id=c.logistics_temp_id')
			->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.temp_id desc ');
		$res['list']=$de;
		$res['page']=$this->ci_page->prompt();
		$this->ci_smarty->assign('re',$res,1,'page');
		$this->ci_smarty->assign("re",$de);
		$this->ci_smarty->display_ini('logistics_list.htm');   
	}
	
	//添加运费模板
	private function logistics_check()
	{
		if($_GET['act']=='check')
		{
			if($_GET['action']=='pass')
				$status=1;
			else
				$status=0;
			//查找
			$de=$this->Base_Logistics_model->get_show_row('temp_id,cityids',array('id'=>$_GET['id']));
			$cids=array_filter(explode(',',$de['cityids']));
			foreach ($cids as $k=>$cityid)
			{
				$this->Base_Logistics_model->update_con(array('status'=>$status),array('define_cityid'=>$cityid,'temp_id'=>$de['temp_id']));
			}

			$res=$this->Base_Logistics_model->update_show(array('status'=>$status),array('id'=>$_GET['id']));
			if(!$res)
			{

				$msg=array(
					'msg'=>"操作失败",
					'type'=>1
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				$msg=array(
					'msg'=>"操作成功",
					'type'=>3
				);
				echo json_encode($msg);
				die;
			}
		}
	}

	//物流企业列表
	public function logccom_list()
	{
		$res = $this->Base_Logistics_model->logccom_list();
		$this->ci_smarty->assign("res",$res);
		$this->ci_smarty->display_ini('logccom_list.htm');   
	}
	
	public function logcom_config()
	{
		$row =  $this->Base_Logistics_model->logccom_list();
		if(!empty($row))
		{
		   $str = "<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
		   foreach($row as $v)	
		   $str.= "\$config[".$v['type']."]='".$v['company']."'; \n";
		   create_file(APPPATH."/cache/logccom_type.php", $str);
		}
	}

	//添加或修改物流企业
	public function logccom_add()
	{
		//判断是否有数据提交
		if (!empty($_POST)) 
		{						
			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('type', '物流企业编号', 'required|max_length[3]');
			$this->form_validation->set_rules('company', '物流企业名称', 'required|max_length[20]');			
			
			//表单验证，通过进行赋值，不通过提示错误并返回
			if ($this->form_validation->run() == FALSE)
			{
				$msg=array(
					'msg'=>validation_errors("<i class='icon-comment-alt'></i> "),
					'type'=>1
				);	
				echo json_encode($msg);
				die;
			}
			else
			{
				//以数组类型添加或者修改数据库
				$logccom_arr = array();
				$logccom_arr['type']    = $this->input->post('type',true);
				$logccom_arr['company'] = $this->input->post('company',true);
				//生成物流编号配置文件

				//判断是否存在id，没有进行添加，有进行修改
				if (!empty($_POST['id'])) 
				{									
				    $flag = $this->Base_Logistics_model->logccom_updata($logccom_arr,array('id'=>$_POST['id']));
				    $this->logcom_config(); 
					if($flag)
					{
						//关闭窗口刷新页面	
						//$this->ci_smarty->assign('close_msg',1);
						$msg=array(
							'msg'=>"操作成功",
							'type'=>3
						);
						echo json_encode($msg);
				  	    die;
					}
					else
					{
						$msg=array(
							'msg'=>'操作失败',
							'type'=>1
						);	
						echo json_encode($msg);
						die;
					}									
				}
				else
				{
					$flag = $this->Base_Logistics_model->logccom_add($logccom_arr);
					$this->logcom_config(); 
					if($flag)
					{
						$msg=array(
							'msg'=>"操作成功",
							'type'=>3
						);
						echo json_encode($msg);
				  	    die;
					}
					else
					{
						$msg=array(
							'msg'=>'操作失败',
							'type'=>1
						);	
						echo json_encode($msg);
						die;
					}
				}
			}		
		}

		//判断是否存在id，没有进行添加，有进行修改
		if (!empty($_GET['id'])) 
		{     		
     		$lo_res = $this->Base_Logistics_model->get_logccom(array('id'=>$_GET['id']));
     		$this->ci_smarty->assign('lo_res',$lo_res);
		}

		//防止csrf攻击
		$this->security->get_csrf_token_name();
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->ci_smarty->assign('csrf',$csrf);
		
		//加载页面
		$this->ci_smarty->display_ini('logccom_add.htm');  
	}
}


