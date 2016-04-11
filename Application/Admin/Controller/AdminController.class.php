<?php
/**
 * Created by PhpStorm.
 * User: Ewan
 * Date: 2016/4/11
 * Time: 16:56
 */
namespace Admin\Controller;

use Think\Controller;

class AdminController extends Controller
{

    public function addAdmin(){
        if(IS_POST){
            $inf=NULL;
            $data=I('post.');
//            print_r($data);
            $mes=D('Admin')->registerAdmin($data);
            foreach($mes as $a){
                $inf.=$a;
            }
           if($mes){
               $this->error($inf);
           }else{
               $this->success("Ìí¼Ó³É¹¦",'/Admin/index');
           }
        }else{
        $this->display();}
    }
    public function listAdmin(){
       $mes= D('Admin')->listAdmin();
//        print_r($mes);
        $this->assign('userInf',$mes);
        $this->display();
    }
    public function editAdmin(){
        if(IS_POST){
            $inf=NULL;
            $id=I('get.id',0,'int');
            $data=I('post.');

//            echo $id;
//            print_r($data);
//            exit;
            $mes=D('Admin')->editAdmin($id,$data);
            foreach($mes as $a){
                $inf.=$a;
            }
            if($mes){
                $this->error($inf);
            }else{
                header("Location:".U('Admin/listAdmin'));
            }
        }else {
            $id = I('id', 0, 'int');
//        echo $id;
            $mes = D('Admin')->where("id='{$id}'")->find();
            $this->assign('userInf', $mes);
            $this->display();
        }
    }
    public function deleteAdmin(){
        $id=I('id',0,'int');
//        print_r($id);
        if(M('Admin')->where("id='{$id}'")->delete()){
            header("Location:".U('Admin/listAdmin'));
        }else{
            header("Location:".U('Admin/listAdmin'));
        }
    }

}