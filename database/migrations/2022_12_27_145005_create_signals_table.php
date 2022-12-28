<?php

use App\Models\SignalProvider;
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
        Schema::create('signals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SignalProvider::class, 'signal_provider_id');
            $table->string('signal_provider', 1000);
            $table->string('currency_pair', 255);
            $table->string('order_type', 255);
            $table->string('lot_size', 255);
            $table->string('entry_price', 255);
            $table->string('take_profit1', 255);
            $table->string('take_profit2', 255)->nullable();
            $table->string('take_profit3', 255)->nullable();
            $table->string('stop_loss', 255)->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('signals');
    }
};
