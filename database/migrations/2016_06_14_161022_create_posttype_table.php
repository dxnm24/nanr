<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosttypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_types', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('parent_id');
            $table->integer('relation_id');
            $table->integer('level');
            $table->integer('position');
            $table->string('summary', 1000);
            $table->text('description');
            $table->string('image');
            $table->string('meta_title');
            $table->string('meta_keyword');
            $table->string('meta_description');
            $table->string('meta_image');
            $table->string('limited')->default(PAGINATE_BOX);
            $table->string('sort_by')->default('start_date');
            $table->integer('home')->default(ACTIVE);
            $table->integer('type')->default(ACTIVE);
            $table->integer('display');
            $table->integer('grid')->default(ACTIVE);
            $table->string('color');
            $table->integer('status')->default(ACTIVE);
            $table->string('lang')->default(VI);
            $table->timestamps();
            $table->index('slug', 'post_types_slug_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_types');
    }
}
