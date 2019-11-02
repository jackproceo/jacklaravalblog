<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // 查询数据，并且让查询结果是一个可分页对象
        $blogs = Blog::orderBy('created_at', 'desc') // 调用 Blog模型 的静态方法 orderBy('根据created_at字段', '倒叙排序')
            ->paginate(20); // -> 链式操作：paginate(6) 即数据没页6条
        // 跳转到视图并传值
        return view('blog.index', [ //第一个参数是说，视图模板是 /resources/views/blog/index.blade.php
            'blogs' => $blogs, //这里是说，我们给视图传递一个叫 $'blogs'的变量，值是前面我们查询的数据，也叫$blogs。
        ]); // view() 的第二参数也可以使用 view(..., compact('blogs'))
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create'); //载入视图
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    // 我们只需要调用 Blog模型 的静态方法 create() 插入 $request->post() 数据即可
    $blog = Blog::create($request->post()); //改方法的返回值是新插入的数据生成的对象
    // redirect() 页面重定向
    return redirect()->route('blog.show', $blog); // 这里我们将 $blog 作为参数请求 BlogController@show

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $blog->content=nl2br($blog->content);
        return view('blog.show', [
        'blog' => $blog, //直接将$blog传给视图进行渲染
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit', [
        'blog' => $blog,
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $blog->update($request->post()); //调用 $blog对象->update(更新数据组成的数组) 更新
        return redirect()->route('blog.show', $blog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
         $blog->delete();
         session()->flash('success', '删除文章成功！'); //装载session闪存
        return redirect()->route('blog.index'); //跳转到首页
    }
}
