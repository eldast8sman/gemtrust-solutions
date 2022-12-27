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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 255)->nullable()->after('email');
            $table->integer('filename')->nullable()->after('password');
            $table->integer('compressed')->nullable()->after('filename');
            $table->string('verification_token', 255)->nullable()->after('compressed');
            $table->timestamp('verification_token_expiry')->nullable()->after('verification_token');
            $table->string('token', 255)->nullable()->after('verification_token_expiry');
            $table->timestamp('token_expiry')->nullable()->after('token');
            $table->string('bank', 255)->nullable()->after('token_expiry');
            $table->string('bank_code', 255)->nullable()->after('bank');
            $table->string('bank_nip', 255)->nullable()->after('bank_code');
            $table->string('account_number')->nullable()->after('bank_nip');
            $table->string('account_name')->nullable()->after('account_number');
            $table->string('referral_code', 1000)->after('name');
            $table->integer('status')->default(1)->after('account_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('filename');
            $table->dropColumn('compressed');
            $table->dropColumn('verification_token');
            $table->dropColumn('verification_token_expiry');
            $table->dropColumn('token');
            $table->dropColumn('bank');
            $table->dropColumn('bank_code');
            $table->dropColumn('bank_nip');
            $table->dropColumn('account_number');
            $table->dropColumn('account_name');
            $table->dropColumn('referral_code');
            $table->dropColumn('status');
        });
    }
};
