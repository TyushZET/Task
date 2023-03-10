<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('description');
            $table->unsignedBigInteger('website_id');
            $table->foreign('website_id')->references('id')->on('websites');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

//$table->unsignedBigInteger('user_id');
//$table->unsignedBigInteger('post_id');
//
//$table->foreign('user_id')->references('id')->on('subscribers')
//    ->onDelete('cascade');
//$table->foreign('post_id')->references('id')->on('posts')
//    ->onDelete('cascade');

//protected $fillable = [
//    'user_id',
//    'post_id',
//];
