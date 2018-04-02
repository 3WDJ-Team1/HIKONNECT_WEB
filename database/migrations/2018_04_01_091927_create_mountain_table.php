<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMountainTable extends Migration
{
    private $_table = 'mountain';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'mountain', 
            function (Blueprint $table) {
                $table->integer('mnt_code');
                $table->string('mnt_name', 20);

                $table->primary(['mnt_code', 'mnt_name']);
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mountain');
    }
}
