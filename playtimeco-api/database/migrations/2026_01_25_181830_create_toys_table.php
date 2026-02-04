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
        Schema::create('toys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supervisor')->nullable()->constrained('users')->nullOnDelete(); // null if the assigned supervisor is deleted
            $table->string('alias');
            $table->string('name');
            $table->integer('subject');
            $table->enum('status', ['Alive', 'Deceased']);
            $table->date('creation_date');
            $table->string('species');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toys');
    }
};
