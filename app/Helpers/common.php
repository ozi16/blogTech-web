<?php

/**
 * SITE INFORMATION
 */

use App\Models\GeneralSetting;
use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;


/**
 * Site Information
 */
if (!function_exists('settings')) {
    function settings()
    {
        $settings = GeneralSetting::take(1)->first();

        if (!is_null($settings)) {
            return $settings;
        }
    }
}

/** 
 * Dynamic Navigation Menus 
 * */
if (!function_exists('navigations')) {
    function navigations()
    {
        $navigation_html = '';

        // With dropdown
        $pcategories = ParentCategory::whereHas('children', function ($q) {
            $q->whereHas('posts');
        })->orderBy('name', 'asc')->get();

        // without dropdown
        $categories = Category::whereHas('posts')->where('parent', 0)->orderBy('name', 'asc')->get();

        if (count($pcategories) > 0) {
            foreach ($pcategories as $item) {
                $navigation_html .= '
                    <li><a href="#">' . $item->name . ' <i class="ti-angle-down ml-1"></i></a>
                        
                    <ul class="submenu">
                ';

                foreach ($item->children as $category) {
                    if ($category->posts->count() > 0) {
                        $navigation_html .= '<li><a href="' . route('category_posts', $category->slug) . '">' . $category->name . '</a></li>';
                    }
                }

                $navigation_html .= '
                       </ul>
                    </li>
                ';
            }
        }

        if (count($categories) > 0) {
            foreach ($categories as $item) {
                $navigation_html .= '
                
                <li><a href="' . route('category_posts', $category->slug) . '">' . $item->name . '</a></li>
                ';
            }
        }
        return $navigation_html;
    }
}

/**
 * Date Format eg: January 12, 2025
 */
if (!function_exists('date_formatter')) {
    function date_formatter($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->isoFormat('LL');
    }
}

/**
 * Strip Word
 */
if (!function_exists('readDuration')) {
    function readDuration(...$text)
    {
        Str::macro('timeCounter', function ($text) {
            $totalWords = str_word_count(implode(" ", $text));
            $minuteToRead = round($totalWords / 200);
            return (int)max(2, $minuteToRead);
        });
        return Str::timeCounter($text);
    }
}

/**
 * DISPLAY LATEST POST ON HOMEPAGE
 */
if (!function_exists('latest_posts')) {
    function latest_posts($skip = 0, $limit = 5)
    {
        return Post::skip($skip)
            ->limit($limit)
            ->where('visibility', 1)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

/**
 * LISTING CATEGORIES WITH NUMBER OF POST ON SIDEBAR
 */
if (!function_exists('sidebar_categories')) {
    function sidebar_categories($limit = 8)
    {
        return Category::withCount('posts')
            ->having('posts_count', '>', 0)
            ->limit($limit)
            ->orderBy('posts_count', 'desc')
            ->get();
    }
}

/**
 * FETCH ALL TAGS FROM THE 'post' TABLE
 */
if (!function_exists('getTags')) {
    function getTags($limit = null)
    {
        $tags = Post::where('tags', '!=', '')->pluck('tags');
        // Split the tags into an array and remove duplicates
        $uniqueTags = $tags->flatMap(function ($tagsString) {
            return explode(',', $tagsString);
        })->map(fn($tag) => trim($tag)) //Trim any extra whitespace
            ->unique()
            ->sort()
            ->values();

        if ($limit) {
            $uniqueTags = $uniqueTags->take($limit);
        }
        return $uniqueTags->all();
    }
}

/** 
 * LISTING SIDEBAR LATEST POSTS 
 */
if (!function_exists('sidebar_latest_posts')) {
    function sidebar_latest_posts($limit = 5, $expect = null)
    {
        $post = Post::limit($limit);
        if ($expect) {
            $post = $post->where('id', '!=', $expect);
        }
        return $post->where('visibility', 1)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
