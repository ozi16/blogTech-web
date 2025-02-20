<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class Comments extends Component
{
    public $post;
    public $comments;
    public $comment;
    public $name;
    public $email;
    public $parent_id = null;

    protected $rules = [
        'comment' => 'required|string',
        'name' => 'required|string',
        'email' => 'required|email',
    ];

    public function mount($post)
    {
        $this->post = $post;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = Comment::where('post_id', $this->post->id)
            ->whereNull('parent_id')
            ->with('replies')
            ->latest()
            ->get();
    }

    public function saveComment()
    {
        $this->validate();

        Comment::create([
            'post_id' => $this->post->id,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'email' => $this->email,
            'comment' => $this->comment
        ]);

        $this->reset(['comment', 'name', 'email', 'parent_id']);
        $this->loadComments(); // Reload komentar

        session()->flash('message', 'Comment added successfully.');
    }

    public function setReply($commentId)
    {
        $this->parent_id = $commentId;
    }


    public function render()
    {
        return view('livewire.comments');
    }
}
