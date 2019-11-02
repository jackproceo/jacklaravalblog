@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">文章详情</div>

            <div class="card-body">
                <h1 class="text-center">{{ $blog->title }}</h1>

                <p>发布时间<small>{{ $blog->created_at }}</small>
                <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-info">编辑文章</a>
                <a href="javascript:deleteConfirm({{ $blog->id }});" class="btn btn-danger btn-sm">删除文章</a>

{{--  因为删除也需要 csrf 令牌认证，所以弄个表单  --}}
<form method="POST" action="{{ route('blog.destroy', $blog->id) }}" id="delete-blog-{{ $blog->id }}">
    @csrf
    {{--  这里伪造DELETE请求  --}}
    @method("DELETE")
</form>
</p>

                <hr>

                <p> {!! $blog->content !!} </p>
            </div>
        </div>
    </div>
</div>

@endsection
