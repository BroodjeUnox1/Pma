<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Klas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klas', function (Blueprint $table) {
            $table->id();
            $table->string('klascode');
            $table->string('leerling1');
            $table->string('leerling2');
            $table->string('leerling3');
            $table->string('leerling4');
            $table->string('leerling5');
            $table->string('leerjaar');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('klas');

    }
}
