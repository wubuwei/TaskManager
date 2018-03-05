<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\ProjectsRepository;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\EditProjectRequest;
use App\Project;
use Redirect;
use Auth;

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

    //使用CreateProjectRequest来注入，因为它是继承自Request扩展的
    //这样可以直接验证了
    public function store(CreateProjectRequest $request)
    {
/*      //尽量不要这样写，在controller又执行了验证逻辑 
        $this->validate($request, [
            'name' => 'required'
        ]);*/
        //$request包含表单传过来的name数据，还有当前用户
        //通过Request可以使用user()获取用户信息，类似等同于Auth::user(),不再深挖，暂时挖不动了。
        //dd($request->user());
        $this->Repo->newProject($request);
        return Redirect::back();
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


    public function show($name)
    {
        //get方法取回的是集合，first取回的实例
        $project = Auth::user()->projects()->where('name', $name)->first();
        return view('projects.show', compact('project'));
    }


    public function edit($id)
    {
        //
    }


    public function update(EditProjectRequest $request, $id)
    {
        $this->Repo->updateProject($request, $id);

        return Redirect::back();
    }


    public function destroy($id)
    {
        Project::find($id)->delete();
        
        return Redirect::back();
    }
}
