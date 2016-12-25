<?php
/**
 * Created by PhpStorm.
 * User: Cral
 * Date: 2016/12/24 0024
 * Time: 下午 2:51
 */

namespace app\controller;


use app\model\ToDo;

class HomeController extends BaseController
{
    public function show()
    {
        echo 'home,show';
    }

    public function migrate(){
        $migrator = new \Pheasant\Migrate\Migrator();
        $migrator->initialize(ToDo::schema());
    }

    public function create(){
        $todo = new ToDo();
        $todo->title = '设计自己的mvc框架';
        $todo->status = true;
        $todo->save();
    }

    public function showAll(){
        $todos = ToDo::all();
        foreach ($todos as $todo){
            $parameters['items'][]=['title'=>$todo->title,'id'=>$todo->id,'status'=>$todo->status];
        }
        $latte = new \Latte\Engine;
        $latte->render(APP_ROOT.'/view/template.latte', $parameters);
    }

    //添加数据
    public function createdata(){
        $todo = new ToDo();
        $todo->title = $_POST['content'];
        $todo->status = true;
        if($todo->save()){
            echo 1;
        }else{
            echo 0;
        }
    }
    //删除数据
    public function del(){
        $todo = new ToDo();
        $id = $_POST['id'];
        $todo = ToDo::byId($id);
        if($todo->delete()){
            echo 1;
        }else{
            echo 0;
        }
    }
    //修改数据
    public function updated(){
        $todo = new ToDo();
        $id = $_POST['id'];
        $todo = ToDo::byId($id);
        $todo->status = false;
        if($todo->save()){
            echo 1;
        }else{
            echo 0;
        }
    }
}