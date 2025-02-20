<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use illuminate\Support\Str;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;


class BlogController extends Controller
{
    public function index(Request $request)
    {
        $title = isset(settings()->site_title) ? settings()->site_title : '';
        $description = isset(settings()->site_meta_description) ? settings()->site_meta_description : '';
        $imagURL = isset(settings()->site_logo) ? asset('images/site/' . settings()->site_logo)  : '';
        $keywords = isset(settings()->site_meta_keywords) ? settings()->site_meta_keywords : '';
        $currentUrl = url()->current();

        /* Meta SEO */
        SEOTools::setTitle($title, false);
        SEOTools::setDescription($description);
        SEOMeta::setKeywords($keywords);

        /* Open Graph */
        SEOTools::opengraph()->setUrl($currentUrl);
        SEOTools::opengraph()->addImage($imagURL);
        SEOTools::opengraph()->addProperty('type', 'articles');

        /* Twitter */
        SEOTools::twitter()->addImage($imagURL);
        SEOTools::twitter()->setUrl($currentUrl);
        SEOTools::twitter()->setSite('@blogTech');


        $data = [
            'pageTitle' => $title
        ];

        return view('front.pages.index', $data);
    }

    public function categoryPosts(Request $request, $slug = null)
    {
        //Find category by slug
        $category = Category::where('slug', $slug)->firstOrFail();

        //Rertieve post related to this author, category and paginate
        $posts = Post::where('category', $category->id)
            ->where('visibility', 1)
            ->paginate(8);

        $title = 'Post in category: ' . $category->name;
        $description = 'Browse the latest post in the ' . $category->name . 'category. Stay updated with articles, insights, and tutorials.';

        /** Set SEO Meta Tags */
        SEOTools::setTitle($title, false);
        SEOTools::setDescription($description);
        SEOTools::opengraph()->setUrl(url()->current());

        $data = [
            'pageTitle' => $category->name,
            'posts' => $posts
        ];
        return view('front.pages.category_posts', $data);
    }

    public function authorPosts(Request $request, $username = null)
    {
        // Find the author based on the username
        $author = User::where('username', $username)->firstOrFail();

        // Retrieve posts related to this author and paginate
        $posts = Post::where('author_id', $author->id)
            ->where('visibility', 1)
            ->orderBy('created_at', 'asc')
            ->paginate(9);
        $title = $author->name . '- Blog Posts';
        $description = 'Explore the latest post by .' . $author->name . ' on Various topics';

        /** Set SEO Meta Tags */
        SEOTools::setTitle($title, false);
        SEOTools::setDescription($description);
        SEOTools::setCanonical(route('author_posts', ['username' => $author->username]));
        SEOTools::opengraph()->setUrl(route('author_posts', ['username' => $author->username]));
        SEOTools::opengraph()->addProperty('type', 'profile');
        SEOTools::opengraph()->setProfile([
            'first_name' => $author->name,
            'username' => $author->username
        ]);

        $data = [
            'pageTitle' => $author->name,
            'author' => $author,
            'posts' => $posts
        ];
        return view('front.pages.author_posts', $data);
    }

    public function tagPost(Request $request, $tag = null)
    {
        // Query post that have the selected tag
        $posts = Post::where('tags', 'LIKE', "%{$tag}%")->where('visibility', 1)->paginate(8);

        /** For Meta Tags */
        $title = "Post tagged with {$tag}";
        $description = "Explore all post tagged with {$tag} on our blog.";

        /** Set SEO Meta Tags */
        SEOTools::setTitle($title, false);
        SEOTools::setDescription($description);
        SEOTools::setCanonical(url()->current());

        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');

        $data = [
            'pageTitle' => $title,
            'tag' => $tag,
            'posts' => $posts
        ];
        return view('front.pages.tag_posts', $data);
    }

    public function searchPost(Request $request)
    {
        // Get search query from the input
        $query = $request->input('q');

        // If query is not empty, process the search
        if ($query) {
            $keywords = explode(' ', $query);
            $postQuery = Post::query();

            foreach ($keywords as $keyword) {
                $postQuery->orWhere('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('tags', 'LIKE', '%' . $keyword . '%');
            }
            $posts = $postQuery->where('visibility', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(9);

            /**For Meta Tags */
            $title = "Search results for {$query}";
            $description = "Browse search result for {$query} on our blog.";
        } else {
            $posts = collect();

            /** From Meta Tags */
            $title = 'Search';
            $description = 'Search for blog posts on our website. ';
        }

        SEOTools::setTitle($title, false);
        SEOTools::setDescription($description);

        $data = [
            'pageTitle' => $title,
            'query' => $query,
            'posts' => $posts
        ];

        return view('front.pages.search_posts', $data);
    }

    public function readPost(Request $request, $slug = null)
    {
        // Fetch single post by slug
        $post = Post::where('slug', $slug)->firstOrFail();

        // Get related posts
        $relatedPosts = Post::where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->where('visibility', 1)
            ->take(3)
            ->get();

        // Get the next post
        $nextPost = Post::where('id', '>', $post->id)
            ->where('visibility', 1)
            ->orderBy('id', 'asc')
            ->first();

        // Get the previous post
        $previousPost = Post::where('id', '<', $post->id)
            ->where('visibility', 1)
            ->orderBy('id', 'asc')
            ->first();

        // Set SEO Meta tags
        $title = $post->title;
        $description = ($post->meta_description != '') ? $post->meta_description : Str::words($post->content, 35);

        SEOTools::setTitle($title, false);
        SEOTools::setDescription($description);
        SEOTools::opengraph()->setUrl(route('read_post', ['slug' => $post->slug]));
        SEOTools::opengraph()->addProperty('type', 'article');
        SEOTools::opengraph()->addImage(asset('images/posts/' . $post->featured_image));
        SEOTools::twitter()->addImage(asset('images/posts/' . $post->featured_image));

        $data = [
            'pageTitle' => $title,
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'nextPost' => $nextPost,
            'previousPost' => $previousPost,
        ];
        return view('front.pages.single_post', $data);
    }

    public function contactPage()
    {
        $title = 'Contact Us';
        $description = 'Hate Forms? Write Us Email';
        SEOTools::setTitle($title, false);
        SEOTools::setDescription($description);

        return view('front.pages.contact');
    }
}
