<div>
    <aside class="single_sidebar_widget tag_cloud_widget">
        <h4 class="widget_title">Tags</h4>
        
        <ul class="list">
            @foreach (getTags(10) as $tag )
            <li>
                <a class="rounded" href="{{route('tag_posts',urlencode($tag))}}">{{$tag}}</a>
            </li>
            
            @endforeach
        </ul>
    </aside>
</div>