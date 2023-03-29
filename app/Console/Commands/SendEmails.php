<?php

namespace App\Console\Commands;

use App\Jobs\EmailSender;
use App\Mail\MessageSender;
use App\Models\Post;
use App\Models\SentEmail;
use App\Models\Website;
use Illuminate\Console\Command;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;


class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending email to users';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info("Sending posts to subscribers");


        Post::whereDoesntHave('sent_emails')
            ->with('subscribers', function($q){
                $q->whereDoesntHave('sent_emails');
            })
            ->orderBy('id')
            ->chunkById(100, function ($posts) {
                foreach ($posts as $post) {
                    $subscribers = Subscriber::where('website_id', $post->website_id)
                        ->whereDoesntHave('sent_emails')
                        ->get();
                    foreach ($subscribers as $subscriber) {
                        dispatch_sync(new EmailSender($subscriber, $post));
                    }
                }
            });
    }
}


