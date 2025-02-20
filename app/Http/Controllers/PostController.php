<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewsletterJob;
use App\Models\Post;
use App\Models\Category;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use App\Models\ParentCategory;

use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function addPost(Request $request)
    {
        $categories_html = '';
        $pcategories = ParentCategory::whereHas('children')->orderBy('name', 'asc')->get();
        $categories = Category::where('parent', 0)->orderBy('name', 'asc')->get();

        if (count($pcategories) > 0) {
            foreach ($pcategories as $item) {
                $categories_html .= '<optgroup label="' . $item->name . '">';
                foreach ($item->children as $category) {
                    $categories_html .= ' <option value="' . $category->id . '">' . $category->name . '</option>';
                }

                $categories_html .= '</optgroup>';
            }
        }

        if (count($categories) > 0) {
            foreach ($categories as $item) {
                $categories_html .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        }

        $data = [
            'pageTitle' => 'Add New Post',
            'categories_html' => $categories_html,
        ];

        return view('back.pages.add_post', $data);
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts,title',
            'content' => 'required',
            'category' => 'required|exists:categories,id',
            'featured_image' => 'required|mimes:png,jpg,jpeg|max:1024'
        ]);

        // Create Post
        if ($request->hasFile('featured_image')) {
            $path = 'images/posts/';
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . $filename;

            // Upload featured image
            $upload = $file->move(public_path($path), $new_filename);


            if ($upload) {
                /** Generate Resize Image and Thumbnail */
                // $resized_path = $path . 'resized/';
                // if (!File::isDirectory(public_path($resized_path))) {
                //     File::makeDirectory($resized_path, 0777, true, true);
                // }

                // // Thumbnail (Aspect rasio:  1)
                // Image::make($path . $new_filename)
                //     ->fit(250, 250)
                //     ->save(public_path($resized_path . 'thumb_' . $new_filename));

                // // Resized Image (Aspect ratio: 1.6)
                // Image::make($path . $new_filename)
                //     ->fit(512, 320)
                //     ->save(public_path($resized_path . 'resized_' . $new_filename));


                $post = new Post();
                $post->author_id = auth()->id();
                $post->category = $request->category;
                $post->title = $request->title;
                $post->content = $request->content;
                $post->featured_image = $new_filename;
                $post->tags = $request->tags;
                $post->meta_keywords = $request->meta_keywords;
                $post->meta_description = $request->meta_description;
                $post->visibility = $request->visibility;
                $saved = $post->save();

                if ($saved) {
                    /**
                     *  Send email to Newsletter Subscriber
                     */
                    if ($request->visibility == 1) {
                        // Get post detail
                        $latePost = Post::latest()->first();

                        if (NewsletterSubscriber::count() > 0) {
                            $subscribers = NewsletterSubscriber::pluck('email');
                            foreach ($subscribers as $subscriber_email) {
                                SendNewsletterJob::dispatch($subscriber_email, $latePost);
                            }
                            $latePost->is_notified = true;
                            $latePost->save();
                        }
                    }
                    return response()->json(['status' => 1, 'message' => 'New post has been successfully created']);
                } else {
                    return response()->json(['status' => 0, 'message' => 'something went wrong']);
                }
            } else {
                return response()->json(['status' => 0, 'message' => 'something went wrong on uploading a featured image']);
            }
        }
    } // End method

    public function allPost(Request $request)
    {
        $data = [
            'pageTitle' => 'Post'
        ];
        return view('back.pages.posts', $data);
    }

    public function editPost(Request $request, $id = null)
    {
        $post = Post::findOrFail($id);

        $categories_html = '';
        $pcategories = ParentCategory::whereHas('children')->orderBy('name', 'asc')->get();
        $categories = Category::where('parent', 0)->orderBy('name', 'asc')->get();

        if (count($pcategories) > 0) {
            foreach ($pcategories as $item) {
                $categories_html .= '<optgroup label="' . $item->name . '">';
                foreach ($item->children as $category) {
                    $selected = $category->id == $post->category ? 'selected' : '';
                    $categories_html .= '<option value="' . $category->id . '" ' . $selected . '>' . $category->name . '</option>';
                }

                $categories_html .= '</optgroup>';
            }
        }

        if (count($categories) > 0) {
            foreach ($categories as $item) {
                $selected = $item->id == $post->category ? 'selected' : '';
                $categories_html .= '<option value="' . $item->id . '" ' . $selected . '>' . $item->name . '</option>';
            }
        }

        $data = [
            'pageTitle' => 'Edit',
            'post' => $post,
            'categories_html' => $categories_html
        ];

        return view('back.pages.edit_post', $data);
    }

    public function updatePost(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $featured_image_name = $post->featured_image;

        // VALIDATE THE FORM
        $request->validate([
            'title' => 'required|unique:posts,title,' . $post->id,
            'content' => 'required',
            'category' => 'required|exists:categories,id',
            'featured_image' => 'nullable|mimes:jpeg,jpg,png|max:1024'
        ]);

        if ($request->hasFile('featured_image')) {
            $old_featured_image = $post->featured_image;
            $path = 'images/posts/';
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . $filename;

            // upload new featured image
            $upload = $file->move(public_path($path), $new_filename);

            if ($upload) {

                // Delete old featured image
                if ($old_featured_image != null && File::exists(public_path($path . $old_featured_image))) {
                    File::delete(public_path($path . $old_featured_image));
                }

                $featured_image_name = $new_filename;
            } else {
                return response()->json(['status' => 0, 'message' => 'something went wrong while uploading featured image']);
            }
        }

        $sendEmailToSubscribers = ($post->visibility == 0 && $post->is_notified == 0 && $request->visibility == 1) ? true : false;

        // UPDATE POST IN DATABASE
        // $post->author_id = auth()->id();
        $post->category = $request->category;
        $post->title = $request->title;
        $post->slug = null;
        $post->content = $request->content;
        $post->featured_image = $featured_image_name;
        $post->tags = $request->tags;
        $post->meta_keywords = $request->meta_keywords;
        $post->meta_description = $request->meta_description;
        $post->visibility = $request->visibility;
        $saved = $post->save();

        if ($saved) {
            /**
             * Send Newsletter to Subscribers
             */
            if ($sendEmailToSubscribers) {
                // Get post details
                $currentPost = Post::findOrFail($request->post_id);
                if (NewsletterSubscriber::count() > 0) {
                    $subscribers = NewsletterSubscriber::pluck('email');
                    foreach ($subscribers as $subscribers_email) {
                        SendNewsletterJob::dispatch($subscribers_email, $currentPost);
                    }
                    $currentPost->is_notified = true;
                    $currentPost->save();
                }
            }
            return response()->json(['status' => 1, 'message' => 'Blog has been successfully update']);
        } else {
            return response()->json(['status' => 0, 'message' => 'something went wrong updating']);
        }
    }
}
