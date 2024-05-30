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
        Schema::create('lendings', function (Blueprint $table) {
            $table->id();
            $table->integer('id_employee');
            $table->integer('id_book');
            $table->date('loan_date');
            $table->date('return_date');
            $table->date('loan_limit');
            $table->integer('status')->default(1); //0: Tidak Aktif, 1: Aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * 
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lendings');
    }
};
