<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHikingGroupConstraints extends Migration
{
    private $_table = 'hiking_group';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            $this->_table,
            function (Blueprint $table) {
                $table->foreign('owner')
                    ->references('uuid')->on('user')
                    ->onDelete('cascade');
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
        Schema::table(
            $this->_table,
            function (Blueprint $table) {
                $table->dropForeign('owner');
            }
        );
    }
}
