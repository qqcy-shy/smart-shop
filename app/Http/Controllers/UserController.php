<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
     //访问所有信息
	public function index()
	{
		$list=\DB::table('stu')->get();//获取所有数据
		return view('user.index',['list'=>$list]);//文件名称,参数,值
	}
	//添加页面
	public function show()
	{
		return view('user.add');
	}
	//添加
	public function store(Request $request)
	{
		// echo $request;
		// $m=\DB::table('stu')->insert(['username'=>$request->username,'age'=>$request->age,'sex'=>$request->sex,'class'=>$request->class]);
		$username=$request->username;
		$age=$request->age;
		$sex=$request->sex;
		$class=$request->class;
		$m=\DB::table('stu')->insert(array('username'=>$username,'age'=>$age,'sex'=>$sex,'class'=>$class));
		if($m>0){
			return $this->index(); 
		}
	}
	//删除
	public function destroy($id=null)
	{
		$m=\DB::table('stu')->where('id','=',$id)->delete();
		if($m>0){
			return $this->index();
		}
	}
	//单条查询
	public function edit($id){
		$user=\DB::table('stu')->where('id','=',$id)->first();
		return view('user.edit',['user'=>$user]);
	}
	//修改
	public function update(Request $request,$id){
		// $username=$request->username;
		// $age=$request->age;
		// $sex=$request->sex;
		// $class=$request->class;
		// $m=\DB::table('stu')->where('id',$id)->update(['username'=>$username,'age'=>$age,'sex'=>$sex,'class'=>$class]);
		// if($m>0){
		// 	return $this->index();
		// }
		$m=\DB::table('stu')->where('id',$id)->update(['username'=>$request->username,'age'=>$request->age,'sex'=>$request->sex,'class'=>$request->class]);
		if($m>0){
			return $this->index();
		}
	}
}
