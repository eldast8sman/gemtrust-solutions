<?php

use App\Models\Section;
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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 300);
            $table->longText('content');
            $table->string('filename')->nullable();
            $table->string('compressed')->nullable();
            $table->foreignIdFor(Section::class, 'section_id');
            $table->integer('minimum_level')->nullable();
            $table->string('author')->nullable();
            $table->date('release_date');
            $table->longText('all_details');
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
        Schema::dropIfExists('articles');
    }
};
