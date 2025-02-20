@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Document title')

@section('meta_tags')
    {!!SEO::generate()!!}
@endsection



@section('content')

    <div class=" col-lg-3 col-md-3">
        <div class="d-flex align-items-center section-tittle mb-30">
            <h3 class="">Search for : </h3>
            <span class="pl-1 text-danger ">{{ $query }}</span>
        </div>
    </div>

    

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="container">
                @if (!empty(latest_posts(1,3)))
                    @forelse ($posts as $post )
                        
                        <div class="card mb-3 border-0 shadow-sm rounded">
                            <div class="row g-0 align-items-center mb-4">
                                <!-- Bagian Gambar -->
                                <div class="col-md-3">
                                    <img src="/images/posts/{{ $post->featured_image }}" class="img-fluid rounded" alt="{{ $post->title }}">
                                </div>
                                <!-- Bagian Konten -->
                                <div class="col-md-9">
                                    <div class="card-body py-2 px-3">
                                        <h4 class="card-title mb-1">
                                            <a href="{{ route('read_post', $post->slug) }}" class="text-decoration-none text-dark fw-bold">
                                                {{ $post->title }}
                                            </a>
                                        </h4>
                                        <p class="card-text text-muted mb-1 fs-7">
                                            <small>
                                                <i class="fa fa-user"></i> 
                                                <a href="{{route('author_posts',$post->author->username)}}" class="text-decoration-none text-muted">
                                                    {{ $post->author->name }}
                                                </a>

                                                • {{ date_formatter($post->created_at) }}
                                                • Category: 
                                                <a href="{{route('category_posts',$post->post_category->slug)}}" class="text-decoration-none text-muted">
                                                    {{ $post->post_category->name }}
                                                </a>
                                                <i class="ti-timer mr-1"></i>{{readDuration($post->title,$post->content)}} @choice('min|mins', readDuration($post->title, $post->content))
                                            </small>
                                        </p>
                                        <p class="card-text text-muted fs-7 mb-2 ">{!! Str::ucfirst(Str::words($post->content, 20)) !!}</p>
                                        <a href="{{ route('read_post', $post->slug) }}" class="btn ">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    @empty
                        <span class="text-danger">NO posts found your search.</span>
                    @endforelse

                    {{-- Pagination --}}
                    <div class="pagination-area pb-45 text-center mt-4">
                        {{$posts->appends(request()->input())->links('custom_pagination')}}
                    </div>

                @endif
            </div>
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
                    @foreach (sidebar_latest_posts() as $item )
                        
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
