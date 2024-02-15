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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_date');
            $table->string('date_text');
            $table->text('short_description');
            $table->decimal('price_per_person', 8, 2);
            $table->string('link')->nullable();
            $table->text('long_description');
            $table->foreignId('company_id')->constrained('companies');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
