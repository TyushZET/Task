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
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sentPostsId = SendedEmail::all()->pluck('post_id');
        Post::whereNotIn('id', $sentPostsId)
            ->with('subscribers')
            ->chunk(2, function ($posts) {
                foreach ($posts as $post) {
                    $subscribers = Subscriber::where('website_id', $post->website_id)->get();
                    foreach ($subscribers as $subscriber) {
                        Mail::to($subscriber->email)->send(new MessageSender($post));
                        SendedEmail::create([
                            'user_id' => $subscriber->id,
                            'post_id' => $post->id,
                        ]);
                    }
                }
            });



    }

}
