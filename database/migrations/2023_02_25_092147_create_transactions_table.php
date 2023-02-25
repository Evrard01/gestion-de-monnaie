<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compte_id')->constrained();
            $table->foreignId('type_id')->constrained();
            $table->float('soldeAvant',8,2);
            $table->float('montantTransaction',8,2);
            $table->float('soldeApres',8,2);
            $table->foreignId('recpteur')->references('id')->on('comptes');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
