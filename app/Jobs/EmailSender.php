<?php

namespace App\Jobs;

use App\Console\Commands\SendEmails;
use App\Mail\MessageSender;
use App\Models\Post;
use App\Models\SendedEmail;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailSender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public Post $post;
    public  Subscriber $subscriber;

    public function __construct($subscriber,$post)
    {
        $this->subscriber = $subscriber;
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->subscriber->email)->send(new MessageSender($this->post));
        SendedEmail::create([
            'user_id' => $this->subscriber->id,
            'post_id' => $this->post->id,
        ]);

    }

}
