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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\GroupUser::class, 'paid_by'); // user who paid
            $table->foreignIdFor(\App\Models\GroupUser::class, 'paid_to'); // user who received
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->foreignIdFor(\App\Models\Group::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
