<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            // Ravi: Added manually to add other tables to the post table
            $table->integer('postID');   // field type string
            $table->string('slug');   // field type string
            $table->text('body');   // field type string
            $table->timestamp('failed_at')->useCurrent();
            $table->uuid('uniqueID')->default('uuid');    //Pending: how to use uuid() as default

            $table->timestamps();   // adds created_at and updated_at fields
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
