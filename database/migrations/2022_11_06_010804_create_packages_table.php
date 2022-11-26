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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package', 255);
            $table->text('description')->nullable();
            $table->integer('level')->nullable();
            $table->double('reg_amount')->default(0);
            $table->float('discount')->default(0);
            $table->double('upline1')->default(0);
            $table->double('upline2')->default(0);
            $table->double('upline3')->default(0);
            $table->double('upline4')->default(0);
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
        Schema::dropIfExists('packages');
    }
};
