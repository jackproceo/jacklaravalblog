@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">添加文章</div>

            <div class="card-body">
                {{--  from.method="POST" action="通过 route()函数读取路由别名 " --}}
                <form method="POST" action="{{ route('blog.store') }}">
                    {{--  声明 csrf 令牌  --}}
                    @csrf
                    <div class="form-group">
                        <label for="title">文章标题</label>
                        <input type="text" class="form-control" id="title" placeholder="请输入文章标题" name="title">
                    </div>
                    <div class="form-group">
                        <label for="content">文章内容</label>
                        <textarea id="content" cols="30" rows="10" class="form-control" name="content"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">发布新文章</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
