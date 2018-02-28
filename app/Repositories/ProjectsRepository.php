<?php

namespace App\Repositories;

use Image;

class ProjectsRepository 
{

	//本以为在controller这样写很流弊了，原来还可以这样重构
	//把数据逻辑与controller分离开
	public function newProject($request)
	{
        //神奇之处，从模型的关系入手，而不是new project来用
        //从关系入手，可以避免用户创建别的project
        //project表中有user_id，省去了创建user_id的麻烦，牛逼！
        $request->user()->projects()->create([
            'name' => $request->name,
            'thumbnail' => $this->thumbnail($request)  //$this指本文件，调用本文件thumbnail方法
        ]);
	}


    public function thumbnail($request) 
    {
        //整个过程一步步构建，引入合适的包，合理的使用包
        if ($request->hasFile('thumbnail')) {
            $file = $request->thumbnail;            //获取文件信息
            $name = str_random(10) . '.jpg';        //设置文件名
            $path = public_path() . '/thumbnails/' . $name;   //设置保存的路径 
            Image::make($file)->resize(261,98)->save($path);  //获取文件保存到指定路径

            return $name;
        }
    }
}