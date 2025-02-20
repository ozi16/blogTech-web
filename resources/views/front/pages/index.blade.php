@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Document title')

@section('meta_tags')
{!!SEO::generate()!!}
@endsection

@section('content')

<section class="">
    <div class="">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    @if (!empty(latest_posts(1,3)))
                        @foreach (latest_posts(1,3) as $post )
                            
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-1" src="/images/posts/{{ $post->featured_image }}" alt="">
                                    <a href="#" class="blog_item_date">
                                        <h3>{{ \Carbon\Carbon::parse($post->created_at)->format('d') }}</h3>
                                        <p>{{ \Carbon\Carbon::parse($post->created_at)->format('M') }}</p>
                                    </a>
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="{{route('read_post',$post->slug)}}">
                                        <h2>{{$post->title}}</h2>
                                    </a>
                                    <p>{!! Str::ucfirst(Str::words($post->content,30)) !!}</p>
                                    <ul class="blog-info-link">
                                        <li><a href="{{route('author_posts',$post->author->username)}}"><i class="fa fa-user"></i>{{ $post->author->name }} </a></li>
                                        <li>Date : {{date_formatter($post->created_at)}}</li>
                                        <li>Category :<a href="{{route('category_posts',$post->post_category->slug)}}">{{$post->post_category->name}}</a></li>
                                        <li><i class="ti-timer mr-1"></i>{{readDuration($post->title,$post->content)}} @choice('min|mins', readDuration($post->title, $post->content))</li>
                                        
                                    </ul>
                                </div>
                            </article>
                        @endforeach
                    @endif


                    <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Previous">
                                    <i class="ti-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Next">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    {{-- SearchBar --}}
                    <x-sidebar-search></x-sidebar-search>

                    {{-- Categories --}}
                    <x-sidebar-categories></x-sidebar-categories>

                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Recent Post</h3>
                        <div class="media post_item">
                            <img src="/front/assets/img/post/post_1.png" alt="post">
                            <div class="media-body">
                                <a href="single-blog.html">
                                    <h3>From life was you fish...</h3>
                                </a>
                                <p>January 12, 2019</p>
                            </div>
                        </div>
                        <div class="media post_item">
                            <img src="/front/assets/img/post/post_2.png" alt="post">
                            <div class="media-body">
                                <a href="single-blog.html">
                                    <h3>The Amazing Hubble</h3>
                                </a>
                                <p>02 Hours ago</p>
                            </div>
                        </div>
                        <div class="media post_item">
                            <img src="/front/assets/img/post/post_3.png" alt="post">
                            <div class="media-body">
                                <a href="single-blog.html">
                                    <h3>Astronomy Or Astrology</h3>
                                </a>
                                <p>03 Hours ago</p>
                            </div>
                        </div>
                        <div class="media post_item">
                            <img src="/front/assets/img/post/post_4.png" alt="post">
                            <div class="media-body">
                                <a href="single-blog.html">
                                    <h3>Asteroids telescope</h3>
                                </a>
                                <p>01 Hours ago</p>
                            </div>
                        </div>
                    </aside>
                    
                    {{-- Tags Sidebar --}}
                    <x-sidebar-tags></x-sidebar-tags>


                    <aside class="single_sidebar_widget instagram_feeds">
                        <h4 class="widget_title">Instagram Feeds</h4>
                        <ul class="instagram_row flex-wrap">
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="/front/assets/img/post/post_5.png" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="/front/assets/img/post/post_6.png" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="/front/assets/img/post/post_7.png" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="/front/assets/img/post/post_8.png" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="/front/assets/img/post/post_9.png" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="/front/assets/img/post/post_10.png" alt="">
                                </a>
                            </li>
                        </ul>
                    </aside>


                    <aside class="single_sidebar_widget newsletter_widget">
                        <h4 class="widget_title">Newsletter</h4>

                        <form action="#">
                            <div class="form-group">
                                <input type="email" class="form-control" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                type="submit">Subscribe</button>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection