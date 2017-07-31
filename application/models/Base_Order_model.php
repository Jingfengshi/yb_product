<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Order_model extends CI_Model
{

//订单 添加 返回新插入行的ID
    /*
        传入参数
        $data  arr  添加数据

        返回值：返回新插入行的ID
    */
    public function order_add_return_id( $data )
    {
        if ( !is_array($data) || empty($data) )
        {
            return 0;
        }
        $query = $this->db->insert(tab_m('order'), $data);
        return $this->db->insert_id();
    }

    //订单详情 添加
    /*
        传入参数
        $data  arr  添加数据

        返回值：执行条数
    */
    public function order_pro_add( $data )
    {
        if ( !is_array($data) || empty($data) )
        {
            return 0;
        }
        return $this->db->insert_batch(tab_m('order_pro'), $data);
    }

    //获取订单单条信息
    /*
        传入参数
        $fetchFields  str  查询内容
        $where_arr    arr  关键字 搜索内容

        返回值：单条记录
    */
    public function get_order_info($fetchFields,$where_arr)
    {
        if(empty($fetchFields))
        {
            return array();
        }
        if(!is_array($where_arr)||empty($where_arr))
        {
            return array();
        }
        return $this->db->select($fetchFields)
            ->from(tab_m('order'))
            ->where($where_arr)
            ->get()
            ->row_array();
    }

    //获取订单详情单或多条信息
    /*
        传入参数
        $fetchFields  str  查询内容
        $where_arr    arr  关键字 搜索内容

        返回值：单条记录或多条几区
    */
    public function get_order_pro_info($fetchFields,$where_arr)
    {
        if(empty($fetchFields))
        {
            return array();
        }
        if(!is_array($where_arr)||empty($where_arr))
        {
            return array();
        }
        return $this->db->select($fetchFields)
            ->from(tab_m('order_pro'))
            ->where($where_arr)
            ->get()
            ->result_array();
    }

    //订单详情 修改
    /*
        传入参数
        $data       arr   修改数据
        $where_arr  arr   关键字 搜索内容

        返回值：执行条数
    */
    public function order_pro_update($data,$where_arr)
    {
        if(!is_array($data)||empty($data))
        {
            return 0;
        }
        if(!is_array($where_arr)||empty($where_arr))
        {
            return 0;
        }
        return $this->db->update(tab_m('order_pro'), $data, $where_arr);
    }

    //订单 修改
    /*
        传入参数
        $data       arr   修改数据
        $where_arr  arr   关键字 搜索内容

        返回值：执行条数
    */
    public function order_update($data,$where_arr)
    {
        if(!is_array($data)||empty($data))
        {
            return 0;
        }
        if(!is_array($where_arr)||empty($where_arr))
        {
            return 0;
        }
        return $this->db->update(tab_m('order'), $data, $where_arr);
    }

    //供应商订单 添加

    /*
       传入参数
       $data  arr  添加数据

       返回值：返回新插入行的ID
   */
    public function sp_order_add_return_id( $data )
    {
        if ( !is_array($data) || empty($data) )
        {
            return 0;
        }
        $query = $this->db->insert(tab_m('sp_order'), $data);
        return $this->db->insert_id();
    }


    //供应商订单 修改
    /*
        传入参数
        $data       arr   修改数据
        $where_arr  arr   关键字 搜索内容

        返回值：执行条数
    */
    public function sp_order_update($data,$where_arr)
    {
        if(!is_array($data)||empty($data))
        {
            return 0;
        }
        if(!is_array($where_arr)||empty($where_arr))
        {
            return 0;
        }
        return $this->db->update(tab_m('sp_order'), $data, $where_arr);
    }

    //获取供应商订单单条信息
    /*
        传入参数
        $fetchFields  str  查询内容
        $where_arr    arr  关键字 搜索内容

        返回值：单条记录
    */
    public function get_sp_order_info($fetchFields,$where_arr)
    {
        if(empty($fetchFields))
        {
            return array();
        }
        if(!is_array($where_arr)||empty($where_arr))
        {
            return array();
        }
        return $this->db->select($fetchFields)
            ->from(tab_m('sp_order'))
            ->where($where_arr)
            ->get()
            ->row_array();
    }

    //获取供应商订单多条信息
    /*
        传入参数
        $fetchFields  str  查询内容
        $where_arr    arr  关键字 搜索内容

        返回值：多条记录
    */
    public function get_sp_order_info_result($fetchFields,$where_arr)
    {
        if(empty($fetchFields))
        {
            return array();
        }
        if(!is_array($where_arr)||empty($where_arr))
        {
            return array();
        }
        return $this->db->select($fetchFields)
            ->from(tab_m('sp_order'))
            ->where($where_arr)
            ->get()
            ->result_array();
    }

    //获取订单日志多条信息
    /*
        传入参数
        $fetchFields  str  查询内容
        $where_arr    arr  关键字 搜索内容

        返回值：多条记录
    */
    public function get_sp_order_log_info_result($fetchFields,$where_arr)
    {
        if(empty($fetchFields))
        {
            return array();
        }
        if(!is_array($where_arr)||empty($where_arr))
        {
            return array();
        }
        return $this->db->select($fetchFields)
            ->from(tab_m('order_log'))
            ->where($where_arr)
            ->get()
            ->result_array();
    }
    
    /**
     * 获取分销商订单状态
     * 
     */
    public function get_seller_order_status($where_arr)
    {
        if(!is_array($where_arr)||empty($where_arr))
        {
            return array();
        }
       return  $res= $this->db->select('status','payment_status')
            ->from(tab_m('order'))
            ->where($where_arr)
            ->get()
            ->row_array();

    }


    /**
     * 根据供应商订单作废
     */

    public function sp_order_abolish($data,$sp_order_id,$userid)
    {
        $CI=&get_instance();
       // $seller_product_model=$CI->load->model('Seller_product_model');
        $CI->load->model('Sp_Product_model');
        //供应商订单
        if($userid==0)
            $sp_order=$this->get_sp_order_info('order_id,warehouse_id',array('id'=>$sp_order_id));
        else
            $sp_order=$this->get_sp_order_info('order_id,warehouse_id',array('id'=>$sp_order_id,'sp_id'=>$userid));
        //供应商订单改变   sp_order
        if($userid==0)
            $res=$this->sp_order_update($data,array('id'=>$sp_order_id));
        else
            $res=$this->sp_order_update($data,array('id'=>$sp_order_id,'sp_id'=>$userid));
        //供应商订单详情   order_log
        if($userid==0)
            $order_log_info=$this->get_sp_order_log_info_result('num,stock_id,id',array('sp_order_id'=>$sp_order_id));
        else
            $order_log_info=$this->get_sp_order_log_info_result('num,stock_id,id',array('sp_order_id'=>$sp_order_id,'sp_id'=>$userid));
        foreach ( $order_log_info as $k=>$v )
        {
            $this->order_pro_update(array('status'=>-1),array('stock_id'=>$v['stock_id'],'order_id'=>$sp_order['order_id']));
            $sql="UPDATE ".tab_m('sp_product')." SET `online_num`=`online_num`-{$v['num']}  WHERE  `stock_id`={$v['stock_id']}  AND `warehouse_id`={$sp_order['warehouse_id']} ";
            $CI->Sp_Product_model->update_product_sql($sql);
        }
        //判定是否发货完毕
        $fh=1;
        $sp_status=$this->get_sp_order_info_result('delivery_status',array('order_id'=>$sp_order['order_id']));

        foreach ( $sp_status as $k=>$v)
        {
            if($v['delivery_status']==0)
            {
                $fh=2;
            }
        }
        if($fh==1)
        {
            //修改订单状态
            $this->order_update(array('status'=>4),array('id'=>$sp_order['order_id']));
        }
        elseif($fh==2)
        {
            //修改订单状态
            $this->order_update(array('status'=>3),array('id'=>$sp_order['order_id']));
        }
        return $res;
    }

    /**
     * 根据供应商订单发货
     */
    public function sp_order_delivery($data,$sp_order_id,$userid)
    {
        $CI=&get_instance();
        $CI->load->model('Seller_product_model');
        //修改供应商订单
        if($userid==0)
            $res=$this->sp_order_update($data,array('id'=>$sp_order_id));
        else
            $res=$this->sp_order_update($data,array('id'=>$sp_order_id,'sp_id'=>$userid));
        //供应商订单
        if($userid==0)
            $sp_order=$this->get_sp_order_info('order_id,warehouse_id',array('id'=>$sp_order_id));
        else
            $sp_order=$this->get_sp_order_info('order_id,warehouse_id',array('id'=>$sp_order_id,'sp_id'=>$userid));
        //查询订单所属商户
        $order_info=$this->get_order_info('userid',array('id'=>$sp_order['order_id']));

        //修改库存
        if($userid==0)
            $sp_order_info=$this->get_sp_order_log_info_result('stock_id,num',array('sp_order_id'=>$sp_order_id));
        else
            $sp_order_info=$this->get_sp_order_log_info_result('stock_id,num',array('sp_order_id'=>$sp_order_id,'sp_id'=>$userid));
        foreach($sp_order_info as $k=>$v)
        {
            $this->db->where('stock_id',$v['stock_id']);
            $this->db->where('warehouse_id',$sp_order['warehouse_id']);
            $this->db->set('online_num',"online_num - $v[num]",FALSE);
            $this->db->set('c_num',"c_num- $v[num]",FALSE);
            $this->db->set('sell_num',"sell_num + $v[num]",FALSE);
            $this->db->update(tab_m('sp_product'));

            //更改order_pro
            $sql="UPDATE ".tab_m('order_pro')." SET `status`=2 WHERE `stock_id`={$v['stock_id']} AND `order_id`={$sp_order['order_id']}";
            $this->db->query($sql);
            $sql2=" UPDATE ".tab_m('seller_product')." SET `sell_num`=`sell_num`+".$v['num']."  WHERE `userid`={$order_info['userid']} AND `stock_id`={$v['stock_id']} ";
            $CI->Seller_product_model->update_product_sql($sql2);
        }

        //判定是否发货完毕
        $fh=1;
        $sp_status=$this->get_sp_order_info_result('delivery_status',array('order_id'=>$sp_order['order_id']));

        foreach ( $sp_status as $k=>$v)
        {
            if($v['delivery_status']==0)
            {
                $fh=2;
            }
        }
        if($fh==1)
        {
            //修改订单状态
            $this->order_update(array('status'=>4),array('id'=>$sp_order['order_id']));
        }
        elseif($fh==2)
        {

            //修改订单状态
            $this->order_update(array('status'=>3),array('id'=>$sp_order['order_id']));
        }
        
        return $res;
        
    }


}