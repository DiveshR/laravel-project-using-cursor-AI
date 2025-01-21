<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->after('email')->nullable();
            $table->string('address')->after('phone_number')->nullable();
            $table->string('city')->after('address')->nullable();
            $table->string('zip')->after('city')->nullable();
            $table->string('country')->after('zip')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active')->after('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone_number',
                'address',
                'city',
                'zip',
                'country',
                'status'
            ]);
        });
    }
};