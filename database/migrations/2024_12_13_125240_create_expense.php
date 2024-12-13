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
        Schema::create('expense', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->float('amount');
            $table->date('date');
            $table->foreignIdFor(\App\Models\Group::class, 'group_id'); // group for which the expense was made
            $table->foreignIdFor(\App\Models\User::class, 'payer_id'); // user who paid the expense
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense');
    }
};
