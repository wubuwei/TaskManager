<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Image;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
