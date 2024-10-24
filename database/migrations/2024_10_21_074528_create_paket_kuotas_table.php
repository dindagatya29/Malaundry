<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('paket_kuotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('berat', 8, 2);
            $table->foreignId('satuan_unit_id')->constrained('satuan_units');
            $table->decimal('harga', 10, 2);
            $table->string('cabang');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paket_kuotas');
    }
};