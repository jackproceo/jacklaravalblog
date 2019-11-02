@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">编辑文章</div>

            <div class="card-body">
                {{-- action需要声明当前编辑的文章编号$blog->id --}}
                <form method="POST" action="{{ route('blog.update', $blog->id) }}">
                    {{--  声明 csrf 令牌  --}}
                    @csrf
                    {{--  伪造 PATCH 方法  --}}
                    @method("PATCH")
                    <div class="form-group">
                        <label for="title">文章标题</label>
                        <input type="text" class="form-control" id="title" placeholder="请输入文章标题" name="title" value="{{ $blog->title }}">
                    </div>
                    <div class="form-group">
                        <label for="content">文章内容</label>
                        <textarea id="content" cols="30" rows="10" class="form-control" name="content">{{ $blog->content }}</textarea>
                    </div>
                    <p>发表于<small>{{ $blog->created_at }}</small></p>
                    <p>修改于<small>{{ $blog->updated_at }}</small></p>
                    <button class="btn btn-primary" type="submit">确认编辑</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
