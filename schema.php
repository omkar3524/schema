<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            
            $table->unsignedBigInteger('state_id');
            $table->string('state_iso')->nullable();
            $table->string('country_iso');
            $table->string('name');
            $table->tinyInteger('ordering')->default(0);
            $table->timestamps();
;        });

        Schema::create('status_orders', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('keyword');
            $table->tinyInteger('key_id');
            $table->string('name');
            $table->string('help');
        });

        Schema::create('subscribers', function(Blueprint $table){
            $table->unsignedBigInteger('subscriber_id');
            $table->string('email');
            $table->string('firstname');
            $table->string('lastname');
            $table->unsignedBigInteger('create_time');

        });

        Schema::create('terms', function(Blueprint $table){
            $table->unsignedBigInteger('term_id');
            $table->unsignedBigInteger('vocabulary_id');
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('root');
            $table->unsignedBigInteger('lft');
            $table->unsignedBigInteger('rght');
            $table->unsignedBigInteger('level');
            $table->string('term_name');
            $table->text('term_description');
            $table->text('params');
            $table->unsignedBigInteger('total_item');
            $table->unsignedBigInteger('create_time');

        });

        Schema::create('term_relationships', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('node_id');
            $table->unsignedBigInteger('term_id');
        });
        Schema::create('vocabulary', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
        });
        Schema::create('term_relationships', function(Blueprint $table){
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}

