<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('type_main_id');
            $table->integer('seri');
            $table->integer('related');
            $table->integer('type');
            $table->string('url');
            $table->string('summary', 1000);
            $table->text('description');
            $table->string('image');
            $table->string('meta_title');
            $table->string('meta_keyword');
            $table->string('meta_description');
            $table->string('meta_image');
            $table->integer('position');
            $table->string('start_date');
            $table->integer('view');
            $table->integer('is_material')->default(INACTIVE);
            $table->string('material');
            $table->string('post_material');
            $table->integer('status')->default(ACTIVE);
            $table->string('lang')->default(VI);
            $table->timestamps();
            $table->index('slug', 'posts_slug_index');
            $table->index('type_main_id', 'posts_type_main_id_index');
            $table->index('seri', 'posts_seri_index');
            $table->index('related', 'posts_related_index');
            $table->index('type', 'posts_type_index');
            $table->index('start_date', 'posts_start_date_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
