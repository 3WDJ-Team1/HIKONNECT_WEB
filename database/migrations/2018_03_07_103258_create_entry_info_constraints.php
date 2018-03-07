<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntryInfoConstraints extends Migration
{
    private $_table = 'entry_info';
    
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
                $table->foreign('user')
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
                $table->dropForeign('user');
            }
        );
    }
}
