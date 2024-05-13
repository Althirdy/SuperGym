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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique(); // Unique ID for each client
            $table->string('email')->unique();
            $table->string('name');
            $table->foreignId('coach_id')->default(0)->nullable()->constrained(
                table: 'coaches', indexName: 'client_coach_id'

            ); // Assuming 'coach' is a foreign key
            $table->foreignId('goal_id')->constrained(
                table: 'goals', indexName: 'client_goal_id'
            );
            $table->foreignId('subscription_id')->constrained(
                table: 'subscriptions', indexName: 'client_subscription_id'
            );// Assuming 'subscription' is a foreign key
            $table->integer('weight');
            $table->integer('status')->default(0);
            $table->date('expired_at');
            $table->timestamp('added_at')->useCurrent(); // Default to current timestamp when record is saved
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
