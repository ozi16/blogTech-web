
<div>
    <div class="comments-area">
        <h4>{{ count($comments) }} Comments</h4>
    
        @foreach ($comments as $comment)
            <div class="comment-list">
                <div class="single-comment d-flex">
                    <div class="thumb">
                        <img src="{{ asset('assets/img/comment/comment_1.png') }}" alt="">
                    </div>
                    <div class="desc">
                        <p class="comment">{{ $comment->comment }}</p>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <h5><a href="#">{{ $comment->name }}</a></h5>
                                <p class="date">{{ $comment->created_at->format('F j, Y, g:i a') }}</p>
                            </div>
                            <div class="reply-btn">
                                <button wire:click="setReply({{ $comment->id }})" class="btn-reply text-uppercase ml-2">
                                    Reply
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
    
                @foreach ($comment->replies as $reply)
                    <div class="comment-list ml-4">
                        <div class="single-comment d-flex">
                            <div class="thumb">
                                <img src="{{ asset('assets/img/comment/comment_2.png') }}" alt="">
                            </div>
                            <div class="desc">
                                <p class="comment">{{ $reply->comment }}</p>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <h5><a href="#">{{ $reply->name }}</a></h5>
                                        <p class="date">{{ $reply->created_at->format('F j, Y, g:i a') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    
    <!-- Form Comment -->
    <div class="comment-form">
        <h4>{{ $parent_id ? 'Reply to Comment' : 'Leave a Comment' }}</h4>
        <form wire:submit.prevent="saveComment">
            <input type="hidden" wire:model="parent_id">
            <div class="form-group">
                <textarea wire:model="comment" class="form-control w-100" cols="30" rows="5" placeholder="Write Comment"></textarea>
            </div>
            <div class="form-group">
                <input wire:model="name" class="form-control" type="text" placeholder="Name">
            </div>
            <div class="form-group">
                <input wire:model="email" class="form-control" type="email" placeholder="Email">
            </div>
            <div class="form-group">
                <button type="submit" class="button button-contactForm btn_1 boxed-btn">
                    {{ $parent_id ? 'Reply' : 'Send Message' }}
                </button>
            </div>
        </form>
    </div>
    
</div>
