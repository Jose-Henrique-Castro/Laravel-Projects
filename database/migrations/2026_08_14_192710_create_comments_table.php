<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->text('comment');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // constrained = foreign key linked to other table
            $table->foreignId('post_id')->constrained('posts')->cascadeOnDelete(); // cascadeOnDelete = if the father class is deleted all the sons will be deleted as well ( user deleted = posts and comments deleted )

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
