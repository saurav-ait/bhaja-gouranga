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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('donor_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('member_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('donation_category_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('receipt_no')->nullable()->unique();

            $table->decimal('amount', 12, 2);

            $table->enum('payment_method', [
                'cash',
                'bank',
                'bkash',
                'nagad',
                'other'
            ])->default('cash');

            $table->string('transaction_reference')->nullable();

            $table->date('donation_date');

            $table->enum('status', [
                'pending',
                'verified',
                'rejected'
            ])->default('pending');

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('verified_at')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
