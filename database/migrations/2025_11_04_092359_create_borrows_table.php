<?php
// database/migrations/2025_11_04_000002_create_borrows_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->date('borrow_date')->default(now());
            $table->date('return_date')->nullable();
            $table->enum('status',['borrowed','returned'])->default('borrowed');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('borrows');
    }
};
