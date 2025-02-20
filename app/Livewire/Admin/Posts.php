<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Posts extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $categories_html;

    public $search = null;
    public $author = null;
    public $category = null;
    public $visibility = null;
    public $sortBy = 'desc';
    public $post_visibility;

    protected $queryString = [
        'search' => ['except' => ''],
        'author' => ['except' => ''],
        'category' => ['except' => ''],
        'visibility' => ['except' => ''],
        'sortBy' => ['except' => '']
    ];

    protected $listeners = [
        'deletePostAction'
    ];

    public function updateSearch()
    {
        $this->resetPage();
    }
    public function updateAuthor()
    {
        $this->resetPage();
    }
    public function updateCategory()
    {
        $this->resetPage();
    }
    public function updateVisibility()
    {
        $this->resetPage();
        $this->post_visibility = $this->visibility == 'public' ? 1 : 0;
    }

    public function mount()
    {
        // DELETE POST
        $this->author = auth()->user()->type == "superAdmin" ? auth()->user()->id : '';
        // visibility
        $this->post_visibility = $this->visibility == 'public' ? 1 : 0;
        // prepare categories selection
        $categories_html = ' ';

        $pcategories = ParentCategory::whereHas('children', function ($q) {
            $q->whereHas('posts');
        })->orderBy('name', 'asc')->get();

        $categories = Category::whereHas('posts')->where('parent', 0)->orderBy('name', 'asc')->get();

        if (count($pcategories) > 0) {
            foreach ($pcategories as $item) {
                $categories_html .= '<optgroup label="' . $item->name . '">';
                foreach ($item->children as $category) {
                    if ($category->posts->count() > 0) {
                        $categories_html .= '<option value="' . $category->id . '">' . $category->name . '</option>';
                    }
                }
                $categories_html .= '</optgroup>';
            }
        }

        if (count($categories) > 0) {
            foreach ($categories as $item) {
                $categories_html .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        }
        $this->categories_html = $categories_html;
    }

    public function deletePost($id)
    {
        $this->dispatch('deletePost', ['id' => $id]);
    }

    public function deletePostAction($id)
    {
        $post = Post::findOrFail($id);
        $path = "images/posts/";
        $old_featured_image = $post->featured_image;

        // delete featured image
        if ($old_featured_image != "" && File::exists(public_path($path . $old_featured_image))) {
            File::delete(public_path($path . $old_featured_image));
        };

        // delete post from database
        $delete = $post->delete();
        if ($delete) {
            $this->dispatch('showToast', ['type' => 'success', 'delete post successfully']);
        } else {
            $this->dispatch('showToast', ['type' => 'error', 'message' => 'Something went wrong']);
        }
    }
    public function render()
    {
        return view('livewire.admin.posts', [
            'posts' => auth()->user()->type == 'superAdmin' ?
                Post::search(trim($this->search))
                ->when($this->author, function ($query) {
                    $query->where('author_id', $this->author);
                })
                ->when($this->category, function ($query) {
                    $query->where('category', $this->category);
                })
                ->when($this->visibility, function ($query) {
                    $query->where('visibility', $this->post_visibility);
                })
                ->when($this->sortBy, function ($query) {
                    $query->orderBy('id', $this->sortBy);
                })
                ->paginate($this->perPage) :

                Post::search(trim($this->search))
                ->when($this->author, function ($query) {
                    $query->where('author_id', $this->author);
                })
                ->when($this->category, function ($query) {
                    $query->where('category', $this->category);
                })
                ->when($this->visibility, function ($query) {
                    $query->where('visibility', $this->post_visibility);
                })
                ->when($this->sortBy, function ($query) {
                    $query->orderBy('id', $this->sortBy);
                })
                ->where('author_id', auth()->id())->paginate($this->perPage),
        ]);
    }
}
