<?php

namespace App\Jobs;

use App\Mail\MessageSender;
use App\Models\Post;
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
        $subscribers = Subscriber::where('website_id', 7)->get();

        foreach ($subscribers as $subscriber) {
            $email = $subscriber['email'];
            $startOfCurrentHour = now()->subHour()->startOfHour()->toDateTimeString();
            $endOfCurrentHour = now()->subHour()->endofHour()->toDateTimeString();

            $posts = Post::whereBetween('created_at', [$startOfCurrentHour, $endOfCurrentHour])->get();

            foreach ($posts as $post) {
                Mail::to($email)->send(new MessageSender($post));
            }
        }
    }
}
