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
        Schema::table('packages', function (Blueprint $table) {
            $table->double('level1_bonus')->default(0);
            $table->double('level2_bonus')->default(0);
            $table->double('level3_bonus')->default(0);
            $table->double('level4_bonus')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('level1_bonus');
            $table->dropColumn('level2_bonus');
            $table->dropColumn('level3_bonus');
            $table->dropColumn('level4_bonus');
        });
    }
};
