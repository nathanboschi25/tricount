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
        Schema::create('expense_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Expense::class);
            $table->foreignIdFor(\App\Models\GroupUser::class, 'due_by');
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_parts');
    }
};
