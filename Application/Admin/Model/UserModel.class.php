<?php
/**
 * Created by PhpStorm.
 * User: Ewan
 * Date: 2016/4/14
 * Time: 14:56
 */
namespace Admin\Model;

use Think\Model;

class UserModel extends Model
{
    protected $patchValidate =true ;
    protected $_validate = array(//�Զ���֤
        array('username', '/^([\d\w_]){4,20}$/', '�û���������Ӣ�Ļ����ֻ��»��ߣ���4-20��'),
        array('password','/^([\w\d]{4,10})$/','���������4��ʮλ��'),

    );
    protected $_auto =array( //�Զ����
        array('password','md5',3,'function'),

    );
    public function reg($data){

        if (!$this->create($data)) {     // ��data���ݽ�����֤
            return($this->getError());
        } else {
            // ��֤ͨ�� ���Խ����������ݲ���

//            print_r($this->getLastSql());
//            exit;
//            print_r($data);
            if( $this->add())
            {
                return 1;
            }else{
                return 0;
            }

        }
    }
    public function listUser(){
        $page =I('p',1,'int');
        $limit=5;
        $data = $this->order('id DESC')->page($page.','.$limit)->select();
        $count=$this->count();
        $Page=new \Think\Page($count,$limit);
        $show=$Page->show();
        return array(
            "list" =>$data,"page"=>$show);
    }
}