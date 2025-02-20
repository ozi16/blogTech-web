<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Helpers\CMail;


class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $subscriber_email;
    public $currentPost;

    /**
     * Create a new job instance.
     */
    public function __construct($subscriber_email, $currentPost)
    {
        $this->subscriber_email = $subscriber_email;
        $this->currentPost = $currentPost;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = ['post' => $this->currentPost];
        $mail_body = view('email-template.newsletter-post-template', $data);

        $mail_config = array(
            'recipient_address' => $this->subscriber_email,
            'recipient_name' => '',
            'subject' => 'Latest Blog Post',
            'body' => $mail_body
        );

        CMail::send($mail_body);
    }
}
