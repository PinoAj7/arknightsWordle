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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();    
            $table->string('name');                  
            $table->string('faction')->nullable();  
            $table->string('class')->nullable();    
            $table->string('archetype')->nullable();     
            $table->string('rarity')->nullable();    
            $table->string('dp_cost')->nullable();     
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
