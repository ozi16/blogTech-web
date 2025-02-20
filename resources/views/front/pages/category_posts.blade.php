@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Document title')

@section('meta_tags')
    {!!SEO::generate()!!}
@endsection

@section('content')

<h2 class="mb-5 text-center  " style="color: #f44a40;">{{$pageTitle}}</h2>

@if ($posts->count())    

<div class="container">
    
    <div class="row">
            @foreach ($posts as $post )
                <div class="col-md-4 col-sm-12 mb-4">
                    <div class="card shadow">
                    <div class="cutter position-relative">
                        <img src="/images/posts/{{$post->featured_image}}" class="card-img-top" alt="loading">
                    </div>
                    <div class="card-body">
                        <a href="{{route('read_post',$post->slug)}}"><h5 class="card-title text-uppercase text-start">{{$post->title}}</h5></a>
                        <ul class="blog-info-link">
                            <li>Author :<a href="{{route('author_posts',$post->author->username)}}"><i class=""></i>{{ $post->author->name }}  </a></li>
                            <li>Date : {{date_formatter($post->created_at)}}</li>
                            
                        </ul>
                    </div>
                    </div>
                </div>
            @endforeach
    </div>
</div>

@else
    <p><span class="text-danger">No Post found in this category</span></p>
@endif

{{-- Pagination --}}
<div class="pagination-area pb-45 text-center mt-4">
    {{$posts->appends(request()->input())->links('custom_pagination')}}
</div>



@endsection