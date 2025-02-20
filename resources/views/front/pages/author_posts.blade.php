@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Document title')

@section('meta_tags')
    {!!SEO::generate()!!}
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="/front/assets/css/blogUser.css">
@endpush

@section('content')

<div class="container ">
    
    <div class="row d-flex justify-content-center mb-4">
        
        <div class="col-md-12">
            
            <div class="card p-3 py-4">
                
                <div class="text-center">
                    <img src="https://i.imgur.com/bDLhJiP.jpg" width="100" class="rounded-circle">
                </div>
                
                <div class="text-center mt-3">
                    <span class="bg-secondary p-1 px-4 rounded text-white">{{$author->type}}</span>
                    <h5 class="mt-2 mb-0">{{$author->name}}</h5>
                    
                    
                    <div class="px-4 mt-1">
                        <p class="fonts">{{$author->bio}}</p>
                    </div>
                    
                    @if ($author->social_links)
                        {{-- Social Links --}}
                        <ul class="social-list">
                            @if ($author->social_links->facebook_url) 
                                <a href="{{$author->social_links->facebook_url}}"><li><i class="ti-facebook"></i></i></li></a>
                            @endif

                            @if ($author->social_links->linkedin_url) 
                                <a href="{{$author->social_links->linkedin_url}}"><li><i class="ti-linkedin"></i></li></a>
                            @endif

                            @if ($author->social_links->github_url) 
                                <a href="{{$author->social_links->github_url}}"><li><i class="ti-github"></i></li></a>
                            @endif

                            @if ($author->social_links->instagram_url) 
                                <a href="{{$author->social_links->instagram_url}}"><li><i class="ti-instagram"></i></li></a>
                            @endif
                            
                            @if ($author->social_links->twitter_url) 
                            <a href="{{$author->social_links->twitter_url}}"><li><i class="ti-twitter"></i></li></a>
                            @endif

                            @if ($author->social_links->youtube_url) 
                            <a href="{{$author->social_links->youtube_url}}"><li><i class="ti-youtube"></i></li></a>
                            @endif

                        </ul>
                    @endif
                    
                    
                </div>
            </div>
        </div>
    </div>

   
    <section class="">

        <div class="row">
                
                @forelse ($posts as $post )
                    
                
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
                @empty
                    <div class="col-12">
                        <span class="text-danger text-center">No post found for this author!</span>
                    </div>
                @endforelse
                
        </div>
    </section>
    
</div>
{{-- Pagination --}}
<div class="pagination-area pb-45 text-center mt-4">
    {{$posts->appends(request()->input())->links('custom_pagination')}}
</div>

@endsection