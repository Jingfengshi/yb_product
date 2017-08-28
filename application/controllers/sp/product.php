 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends MY_Controller {
    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');
		$this->load->model('Sp_Product_model');
		$this->load->model('Admin_Country_model');
		$this->load_sp_menu();	
	}

	//我的商品
	public function product_list()
	{
		if($_POST['act']=='删除')
		{
			$this->product_delete();
			return;
		}
		
		//分页
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);  
        $search_page_num = array('all'=>15,1=>15,2=>30,3=>50);
        $this->ci_page->listRows = !isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];

		//搜索字段
		$search_array = array();
		$search_array_like = array();
		$search_array['a.userid']=$this->user_id ;
		if(is_array($_GET)) 
		{
			//非模糊查询字段
			$search_key_ar      = array('status','countryid','stock_id','cat_id','warehouse_id','pic_status');
			//模糊查询字段
			$search_key_ar_more = array('');
			foreach($_GET as $k => $v)
			{
				$skey = substr($k,7,strlen($k)-7); 
				if($k != 'search_page_num' && substr($k,0,7) == 'search_' && !in_array($v,array('all','')))
				{			
					//非模糊查询
					if(in_array($skey,$search_key_ar))
					{	
						$search_array[$skey] = $v;
					}
					//模糊查询
					if(in_array($skey,$search_key_ar_more))
					{
						$search_array_like[$skey] = $v;
					}	
				}
			}
			
			if(!empty($_GET['search_has']))
			{
				if($_GET['search_has']==1)
				{
					$search_array["c_num>"]=0;
				}
				elseif ($_GET['search_has']==-1 )
				{
					$search_array["c_num"]=0;
				}
			}
		}

		$this->load->model('Base_page_model');
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows =$this->Base_page_model
				->where_ar($search_array,$search_array_like)
				->select_one('a.*',tab_m('sp_product').' as a')
				->num_rows();
		}

		$res=array();
		$de=$this->Base_page_model
			->where_ar($search_array,$search_array_like)
			->select_one("a.stock_id,a.pic_status,a.boxes_num,a.status,a.id,a.name,a.ls_lock_num,a.warehouse_id,a.c_num,a.online_num,a.price,b.brand,b.catname,b.gg,b.mark_price,b.mz,b.pic",tab_m('sp_product').' as a')
			->left_join(tab_m('sp_product_content').' as b', 'a.id = b.product_sp_id')
			->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');
		$res['list']=$de;
	    $res['page']=$this->ci_page->prompt();
		$this->ci_smarty->assign('re',$res,1,'page');

		//获取商品类别、产地选项
		$this->ci_smarty->assign('res_stock_cat',$this->Sp_Product_model->get_stock_cat());
		$this->load->model('Admin_Country_model');
		$this->ci_smarty->assign('res_country',$this->Admin_Country_model->get_show_country());

		//查询供应商下有几个仓库
		$this->load->model('Admin_Warehouse_model');
		$this->ci_smarty->assign('warehouse',$this->Admin_Warehouse_model->warehouse_where_list('*',array('sp_uid'=>$this->user_id)));
		
		//显示页面
		$this->ci_smarty->display_ini('product_list.htm');

	}
	
	private function product_delete()
	{
		if(!empty($_POST['item']))
		{
			foreach($_POST['item'] as $id)
			{
				$id*=1;
				if(!empty($id))
					$this->Sp_Product_model->delete_product($id,$this->user_id);
			}	
		}
		header("Location:".site_url('product/product_list'));
		return;
	}
	
	public function get_product_im()
	{
		$this->load->library('CI_xls');
		$title_arr=array('商品名称(中文)','商品英文名称(目前不填)'
			   ,'食品/非食品','品牌','商品类别','产地,','长度(单位:厘米)','宽度(单位:厘米)','高度(单位:厘米)'
			   ,'条形码','售价','市场价','主要成份','功能/用途','毛重(克)','净重(克)','规格/型号','库存(单件数)','每箱数量');
			   
		//第1个表格
		$con_arr1=array('示例商品1-牛肉糖','beef_sugar','食品','test_brand','食品','中国','100','50','20','98475714','29.9','49.9','牛肉等','食用','200','150','AX12312','90','30');
		$this->ci_xls->set_data($title_arr,1,1,'产品列表');
		$this->ci_xls->set_data($con_arr1,2,1);
		$this->ci_xls->get_down_xls('上传产品');	   
		
	}
	
	//导入商品
	public function product_im()
	{
		if(isset($_FILES)&&!empty($_FILES))
		{
			@set_time_limit(0);
			//用户的断开，不终止脚本执行
			@ignore_user_abort(TRUE);
			$warehouse_id=$this->input->post('warehouse_id',true);
			if(empty($warehouse_id))
			{
				$ar_url = array(site_url('product/product_im') => '返回');
				usrl_back_msg('必须选择一个仓库',$ar_url, $this->ci_smarty);
				return;
			}
						
			
			$da = $this->upload_xls(APPPATH."/cache/xls");
			/*
	            [1] => 商品名称(中文)
	            [2] => 商品英文名称
	            [3] => 商品简称
	            [4] => 品牌
	            [5] => 商品类别
	            [6] => 产地
	            [7] => 长度(单位:厘米)
	            [8] => 宽度(单位:厘米)
	            [9] => 高度(单位:厘米)
	            [10] => 条形码
	            [11] => 售价
	            [12] => 市场价
	            [13] => 主要成份
	            [14] => 功能/用途
	            [15] => 食品/非食品
	            [16] => 毛重(克)
	            [17] => 净重(克)
	            [18] => 规格/型号
	            [19] => 库存
				[20] => 箱数
	        */
			//总共导入数据条数
			$data_num = count($da)-1;
			if(is_array($da))
			{
	            $product_arr         = array();
	            $product_content_arr = array();
	            $flag_all = 0;
				$error_str='';
	            foreach ($da as $k => $v) 
	            {
	            	if ($k == 1) 
	            		continue; 

					if(!is_numeric($v['10']))
					{
						$error_str.="行-".$k." 条形码必须为数字 <br>";
						continue;
					}	
					
            		//检测条形码不能重复 
					$row = $this->db->query("SELECT `id` FROM ".tab_m('sp_product')."  WHERE `barcode` ='".$v['10']
					                       ."'  and warehouse_id='$warehouse_id'  and  userid='".$this->user_id."' ")->num_rows;
										   
					if ( empty( $row ) ) 
					{
						//导入到表dferp_sp_product
						$product_arr['warehouse_id']=$warehouse_id;
	            		$product_arr['stock_id'] = '0';
	            		$product_arr['name']     = $v['1'];
	            		$product_arr['barcode']  = $v['10'];
	            		$product_arr['userid']   = $this->user_id;
	            		$product_arr['price']    = $v['11']*1;
	            		$product_arr['c_num']    = $v['18']*1;
	            		$product_arr['uptime']   = date('Y-m-d H:i:s',time());
						$product_arr['status']   = -1;
					    $product_arr['boxes_num']= $v['19']*1;
	            		$product_sp_id           = $this->Sp_Product_model->product_add($product_arr);
	            		//导入到表dferp_sp_product_content
	            		$product_content_arr['userid']        = $this->user_id;
	            		$product_content_arr['product_sp_id'] = $product_sp_id;
	            		$product_content_arr['name']          = $v['1'];
	            		$product_content_arr['desc']          = $v['3'];
	            		$product_content_arr['brand']         = $v['4'];
	            		$product_content_arr['catname']       = $v['5'];
	            		$product_content_arr['country']       = $v['6'];
	            		$product_content_arr['length']        = $v['7']*1;
	            		$product_content_arr['width']         = $v['8']*1;
	            		$product_content_arr['height']        = $v['9']*1;
	            		$product_content_arr['barcode']       = $v['10'];
	            		$product_content_arr['mark_price']    = $v['12']*1;
	            		$product_content_arr['cf']            = $v['13'];
	            		$product_content_arr['gn']            = $v['14'];
	            		$product_content_arr['type']          = $v['3'];
	            		$product_content_arr['mz']            = $v['15'];
	            		$product_content_arr['jz']            = $v['16'];
	            		$product_content_arr['gg']            = $v['17'];
	            		$flag = $this->Sp_Product_model->product_content_add($product_content_arr);	
	            		if ($flag == true) 
	            			$flag_all++;
						else
							$this->db->query("delete  from  ".tab_m('sp_product_content')."  where product_sp_id='$product_sp_id' ");
					}
					else
						$error_str.="行-".$k." 条形码已经存在 <br>";
										            			            			
	            }

        		$ar_url = array(site_url('product/product_im') => '返回');
				usrl_back_msg('导入成功'.$flag_all.",条数据 <br>".$error_str,$ar_url, $this->ci_smarty);

			}
		}
		//商品仓库
		$this->load->model('Admin_Warehouse_model');
		$this->ci_smarty->assign('res_warehouse',$this->Admin_Warehouse_model->warehouse_where_list('id,name,company',array('sp_uid'=>$this->user_id)));
		//跳转页面
		$this->ci_smarty->display_ini('product_import.htm');
	}
	
	private function upload_xls($path)
	{
		setlocale(LC_ALL, 'en_US.UTF-8');
		if(!isset($_FILES['product']['name']))
			return '未上传任何文件';	
		$namear=explode('.',$_FILES['product']['name']);
		if($_FILES['product']["size"]>1024*1024)
			return '导入文件不能超过1M';	
		if($namear[count($namear)-1]!='xls')
			return '导入文件非xls文件';	
		$f=0;
		$f1=$path."/".md5($this->user_id."product").".xls";
		$do1 = copy($_FILES['product']['tmp_name'],$f1);
		unset($_FILES);
		if($do1)
			$f=1;	
		else
			$f=-1;	
		unset($_FILES);	
		if($f==0)
			return "正在导入请稍等";
		if($f==-1)
			return "上传文件失败";
		$pro=array();	
		return get_xlsdata($f1);
	}
	
	//添加/修改我的商品
	public function product_add()
	{	
		//判断是否有数据提交
		if (!empty($_POST)) 
		{	
			$_POST['id']=isset($_POST['id'])?$_POST['id']*1:0;
			$row=$this->Sp_Product_model->get_product('status,stock_id',$_POST['id']);
			$stock_id=$row['stock_id']*1;
			
			
			//表单验证
			$this->load->library('MY_form_validation');	
			if(empty($row)||$stock_id<=0)
			{
				$this->form_validation->set_rules('warehouse_id', '商品仓库', 'required');
				$this->form_validation->set_rules('name', '商品名称', 'required|min_length[2]|max_length[50]'); 
				$this->form_validation->set_rules('barcode', '条形码', 'max_length[30]');
				$this->form_validation->set_rules('price', '我的售价', 'required|numeric');
				$this->form_validation->set_rules('mark_price', '市场价', 'required|numeric');
				$this->form_validation->set_rules('boxes_num', '每箱数量', 'required|is_natural');
				$this->form_validation->set_rules('brand', '品牌', 'required');
				$this->form_validation->set_rules('cat', '商品类别', 'required');
				$this->form_validation->set_rules('country', '产地', 'required');
				$this->form_validation->set_rules('length', '长度', 'required');
				$this->form_validation->set_rules('width', '宽度', 'required');
				$this->form_validation->set_rules('height', '高度', 'required');
				$this->form_validation->set_rules('mz', '毛重(g)', 'required');
				$this->form_validation->set_rules('cf', '主要成分', 'required');
				$this->form_validation->set_rules('gn', '功能/用途', 'required');
				$this->form_validation->set_rules('gg', '规格/型号', 'required');
				$this->form_validation->set_rules('con', '描述详情', 'required');
				$this->form_validation->set_rules('c_num', '库存', 'required|is_natural');
				$this->form_validation->set_rules('pic', '主图', 'required');
			}
			else
				$this->form_validation->set_rules('c_num', '库存', 'required|is_natural');


		
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

				//以数组类型添加到表sp_product
				$product_arr = array();
				$product_arr_content = array();
				if(empty($row)||$stock_id<=0)
				{
					$product_arr['warehouse_id']=$this->input->post('warehouse_id',true)*1;
					$product_arr['name']        = $this->input->post('name',true);
					$product_arr['barcode']     = $this->input->post('barcode',true);
					$product_arr['price']       = $this->input->post('price',true)*1;
					$product_arr['c_num']       = $this->input->post('c_num',true)*1;
				    $product_arr['boxes_num']   = $this->input->post('boxes_num',true)*1;
					$product_arr['status']  = -1;
					
					//返回表sp_product的id,添加失败返回'0'
					//更新表单时不能修改product_sp_id,userid
					if(empty($_POST['id']))
					{

						$product_arr['userid']  = $this->user_id;
						$product_sp_id = $this->Sp_Product_model->product_add($product_arr);
						$product_arr_content['product_sp_id'] = $product_sp_id;
						$product_arr_content['userid']        = $this->user_id;
					}
					//以数组类型添加到表sp_product_content
					$product_arr_content['name']          = $this->input->post('name',true);
					$product_arr_content['desc']          = '';//$this->input->post('desc',true);
					$product_arr_content['brand']         = $this->input->post('brand',true);
					$cat = explode('|', $_POST['cat']);
					$product_arr_content['cat_id']        = $cat[0]*1;
					$product_arr_content['catname']       = urldecode($cat[1]);
					$coun = explode('|', $_POST['country']);
					$product_arr_content['country']       = urldecode($coun[1]);
					$product_arr_content['countryid']     = $coun[0]*1;
					$product_arr_content['length']        = isset($_POST['length'])?$_POST['length']*1:0;
					$product_arr_content['width']         = isset($_POST['width'])?$_POST['width']*1:0;
					$product_arr_content['height']        = isset($_POST['height'])?$_POST['height']*1:0;
					$product_arr_content['barcode']       = $this->input->post('barcode',true);
					$product_arr_content['mark_price']    = isset($_POST['mark_price'])?$_POST['mark_price']*1:0;
					$product_arr_content['cf']            = $this->input->post('cf',true);
					$product_arr_content['gn']            = $this->input->post('gn',true);
					$product_arr_content['type']          = isset($_POST['type'])||$_POST['type']=='食品'?'食品':'非食品';
					$product_arr_content['mz']            = isset($_POST['mz'])?$_POST['mz']*1:0;
					$product_arr_content['jz']            = isset($_POST['jz'])?$_POST['jz']*1:0;
					$product_arr_content['pic']           = $_POST['pic'];
					$product_arr_content['gg']            = $this->input->post('gg',true);
					$product_arr_content['con']           = $this->input->post('con',true);
				}
				else
				{
					$product_arr['c_num']  				  = $this->input->post('c_num',true);
					$c_num_old 			 				  = $this->input->post('c_num_old',true);
					$product_arr_content['con']           = $this->input->post('con',true);
					if(!empty($_POST['pic']))
					{
						$product_arr_content['pic']       = $_POST['pic'];
						$product_arr['pic_status']   	  = 1;
					}
					
					if(empty($_POST['pic'])&&$product_arr['c_num']==$c_num_old)
					{
						$msg=array(
							'msg'=>"无修改",
							'type'=>3
						);
						echo json_encode($msg);
						die;
					}
				}
				
				$flag=false;
				//判断是否存在id，没有进行添加，有进行修改
				if (!empty($_POST['id'])) 
				{					
					$where_ar = array();
					$where_ar['id'] = $_POST['id'];
					$where_ar['userid'] = $this->user_id;
					$flag=$this->Sp_Product_model->update_product($product_arr,$where_ar);
					if($flag&&!empty($product_arr_content))
					{
						$where_ar_content = array();
						$where_ar_content['product_sp_id'] = $_POST['id'];
						$where_ar_content['userid'] = $this->user_id;	
						$flag = $this->Sp_Product_model->update_product_content($product_arr_content,$where_ar_content);
					}
				}
				else
					$flag = $this->Sp_Product_model->product_content_add($product_arr_content);
				
				if($flag===true)
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
		
		//获取商品类别、产地选项、商品所属仓库
		$this->ci_smarty->assign('res_stock_cat',$this->Sp_Product_model->get_stock_cat());
		$this->load->model('Admin_Country_model');
		$this->ci_smarty->assign('res_country',$this->Admin_Country_model->get_show_country());
		$this->load->model('Admin_Warehouse_model');
		$this->ci_smarty->assign('res_warehouse',$this->Admin_Warehouse_model->warehouse_where_list('id,name,company',array('sp_uid'=>$this->user_id)));
		//判断是否存在id，没有进行添加，有进行修改
		if (!empty($_GET['id'])) 
		{     		
     		$product['info'] = $this->Sp_Product_model->get_product('*',$_GET['id'],$this->user_id);
     		$fechfields_product_content = 'mark_price,desc,brand,cat_id,countryid,length,width,height,mz,jz,cf,gn,gg,type,con,pic';
     		$product['content'] = $this->Sp_Product_model->get_product_content($fechfields_product_content,$_GET['id'],$this->user_id);
     		$this->ci_smarty->assign('product',$product);
			$stock_id=$product['info']['stock_id'];
			
     		$this->ci_smarty->assign('act',$stock_id?2:0);
		}
		
		//防止csrf攻击
		$this->security->get_csrf_token_name();
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);


		$this->ci_smarty->assign('csrf',$csrf);
		$this->ci_smarty->assign('ueditor_auth',get_ueditor_auth($this->user_id,WEB_NAME),0);
		//加载页面
		$this->ci_smarty->display_ini('product_add.htm');
	}
	
	
	//商品日志
	public function product_log()
	{       
        //***************************
		//         查询开始	
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql='';
		
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('type','status');
			//姓名模糊查询字段
			$search_key_ar_more=array('pid','order_id');
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
		$sql="select  *  from  ".tab_m('sp_product_log')."  where  1=1  ".$wsql;
		
		if(!$this->ci_page->__get('totalRows'))
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows =$query->num_rows;
		}
		
		$sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query=$this->db->query($sql);
		$res=array();
		
		foreach($query->result_array() as $v)
		{
			$res['list'][]=$v;
		}
		
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
		//查询结束
		//***************************
		$this->ci_smarty->display_ini('product_log.htm');	
	}
}




