@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Document title')

@section('meta_tags')
    {!!SEO::generate()!!}
@endsection


@section('content')

<div class="row">
    <div class="col-lg-8 posts-list">
        <div class="single-post">
           <div class="feature-img">
            <img class="img-fluid" src="/images/posts/{{$post->featured_image}}" alt="">
           </div>
            <div class="blog_details">
                <h2>{{$post->title}}</h2>
                <ul class="blog-info-link mt-3 mb-4">
                    <li><a href="{{route('author_posts',$post->author->username)}}"><i class="fa fa-user"></i>{{ $post->author->name }} </a></li>
                    <li>Date : {{date_formatter($post->created_at)}}</li>
                    <li>Category :<a href="{{route('category_posts',$post->post_category->slug)}}">{{$post->post_category->name}}</a></li>
                    <li><i class="ti-timer mr-1"></i>{{readDuration($post->title,$post->content)}} @choice('min|mins', readDuration($post->title, $post->content)) @choice('min|mins',readDuration($post->title,$post->content))</li>
                    
                </ul>
                <p class="excert">
                    {!!$post->content!!}
                </p> 
            </div>
        </div>
        <div class="navigation-top ">
            <div class="d-sm-flex justify-content-between text-center ">
                <p class="like-info"><span class="align-middle"><i class="fa fa-heart"></i></span> Lily and 4
                    people like this</p>
                {{-- <div class="col-sm-4 text-center my-2 my-sm-0">
                    <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> 06 Comments</p> 
                </div> --}}
                <ul class="social-icons ">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fa fa-behance"></i></a></li>
                </ul>
            </div>
           <div class="navigation-area">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                     
                    @if ($previousPost)
                        <div class="thumb">
                            <a href="#">
                                <img style="max-width: 80px; height: auto;" class="img-fluid rounded" src="/images/posts/{{$previousPost->featured_image}}" alt="">
                            </a>
                        </div>
                        <div class="arrow">
                            <a href="#">
                                <span class="lnr text-white ti-arrow-left"></span>
                            </a>
                        </div>
                        <div class="detials border">
                            <p>Prev Post</p>
                            <a href="{{route('read_post',$previousPost->slug)}}">
                                <h6>{{$previousPost->title}}</h6>
                            </a>
                        </div>
                    @endif
                </div>
    
                <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                    
                    @if ($nextPost)
                    
                    <div class="detials">
                       <p>Next Post</p>
                       <a href="{{route('read_post',$nextPost->slug)}}">
                        <h6>{{$nextPost->title}}</h6>
                       </a>
                    </div>
                    <div class="arrow">
                       <a href="#">
                          <span class="lnr text-white ti-arrow-right"></span>
                       </a>
                    </div>
                    <div class="thumb">
                        <a href="{{route('read_post',$nextPost->slug)}}">
                            <img style="max-width: 80px; height: auto;" class="img-fluid rounded" src="/images/posts/{{$nextPost->featured_image}}" alt="">
                        </a>
                    </div>
                    @endif
                </div>
            </div>
           </div>
        </div>       

       
        {{-- comments --}}
        @livewire('comments', ['post' => $post])  
        
    </div>

    <div class="col-lg-4">
        <div class="blog_right_sidebar">
            {{-- SearchBar --}}
            <x-sidebar-search></x-sidebar-search>

            {{-- Categories --}}
            <x-sidebar-categories></x-sidebar-categories>

            {{-- Tags --}}
            <x-sidebar-tags></x-sidebar-tags>

            {{-- Latest News --}}
            <aside class="single_sidebar_widget popular_post_widget">
                <h3 class="widget_title">Latest Article</h3>
                @foreach (sidebar_latest_posts(5, $post->id) as $item )
                    
                    <div class="media post_item">
                        <a href="{{route('read_post',$item->slug)}}">
                            <img class="img-fluid rounded" style="max-width: 80px; height: auto;" src="/images/posts/{{$item->featured_image}}" alt="post">
                        </a>
                        <div class="media-body">
                            <a href="{{route('read_post',$item->slug)}}">
                                <h3>{{$item->title}}</h3>
                            </a>
                            <p>{{date_formatter($item->created_at)}}</p>
                        </div>
                    </div>
                @endforeach
                
            </aside>
        </div>
    </div>
</div>


@endsection