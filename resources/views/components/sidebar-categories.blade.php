<div>
    <aside class="single_sidebar_widget post_category_widget">
        <h4 class="widget_title">Category</h4>
        <ul class="list cat-list">
            @foreach (sidebar_categories() as $item )
                
            <li>
                <a href="{{route('category_posts',$item->slug)}}" class="d-flex">
                    {{$item->name}} <small class="ml-auto">({{$item->posts->count()}})</small>
                </a>
            </li>
            @endforeach
        </ul>
    </aside>
</div>