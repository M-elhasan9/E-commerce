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
            $table->string('name')->unique()->nullable(false);
            $table->text('description')->nullable(false);
            $table->string('serial')->unique()->nullable(false);
            $table->string('image')->nullable(false);
            $table->decimal('cost_price',10,2)->nullable(false);
            $table->decimal('selling_price',10,2)->nullable(false);
            $table->string('group');
            $table->boolean('is_visible');
            $table->boolean('is_available');
            $table->string('user');
            $table->string('not');

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
