<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            // rechecked
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('attendanceFlag')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('deleteId')->default(0);           
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
        Schema::dropIfExists('roles');
    }
};
