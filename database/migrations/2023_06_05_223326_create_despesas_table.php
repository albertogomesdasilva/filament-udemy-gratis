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
        Schema::create('despesas', function (Blueprint $table) {
            $table->id();

            $table->string('despesas');
            $table->float('valor')->nullable();
            $table->date('vencimento')->nullable();
            $table->boolean('status')->nullable();
            $table->date('pagamento')->nullable();
            $table->string('obs')->nullable();

            $table->softDeletes();

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despesas');
    }
};
