<?php

use App\Models\Package;
use App\Models\Partner;
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
        Schema::create('package_partners', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Package::class, 'package_id');
            $table->foreignIdFor(Partner::class, 'partner_id');
            $table->double('amount')->default(0);
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
        Schema::dropIfExists('package_partners');
    }
};
