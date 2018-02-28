<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\ProjectsRepository;

class ProjectsController extends Controller
{
    //保护一下Repo变量，只能在本类及其子类使用
    protected $Repo;

    //在构造方法中使用方法注入
    public function __construct(ProjectsRepository $repo)
    {
        $this->Repo = $repo;
    }


    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->Repo->newProject($request);
        return '创建成功！';
    }


/*    public function store(Request $request)
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
    }*/


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
