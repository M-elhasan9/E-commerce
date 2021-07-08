<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(1);
            $table->string('name')->unique()->nullable(false);
            $table->text('description')->nullable(false);
            $table->string('serial')->unique()->nullable(false);
            $table->string('image')->nullable();
            $table->decimal('cost_price',10,2)->nullable(false);
            $table->decimal('selling_price',10,2)->nullable(false);
            $table->unsignedBigInteger('group_id')->default(1);
            $table->boolean('is_visible');
            $table->boolean('is_available');
            $table->string('not');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
