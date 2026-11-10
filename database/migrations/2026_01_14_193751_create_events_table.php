<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            $table->dateTime('start_date'); // datetime exigé :contentReference[oaicite:6]{index=6}
            $table->dateTime('end_date');

            $table->string('place');
            $table->unsignedInteger('capacity');

            $table->boolean('is_free')->default(true);
            $table->decimal('price', 10, 2)->default(0);

            $table->string('image')->nullable();
            $table->enum('status', allowed: ['active', 'archived'])->default('active');

            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
