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
        $subscribers = Subscriber::where('website_id', 27)->get();

        foreach ($subscribers as $subscriber) {
            $email = $subscriber['email'];
            $sub_id = $subscriber['id'];

            $startOfCurrentHour = now()->startOfHour()->toDateTimeString();
            $endOfCurrentHour = now()->endofHour()->toDateTimeString();

            $posts = Post::whereBetween('created_at', [$startOfCurrentHour, $endOfCurrentHour])->get();

            foreach ($posts as $post) {
                $post_id = $post['id'];

                $sendedEmails = SendedEmail::all();
                foreach ($sendedEmails as $sended) {
                    $sendedPost = $sended['post_id'];
                    $sendedUser = $sended['user_id'];
                }
            }
        }
        if ($sendedPost != $post_id) {
            Mail::to($email)->send(new MessageSender($post));
            SendedEmail::create([
                'user_id' => $sub_id,
                'post_id' => $post_id,
            ]);
        } else {
            echo 'This mail are already sended';
        }
    }
}
