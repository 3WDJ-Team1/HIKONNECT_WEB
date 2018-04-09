<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnounceConstratins extends Migration
{
    private $_table = 'announce';

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
                $table->foreign('sender')
                    ->references('uuid')->on('user');
                $table->foreign('addressee')
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
                $table->dropForeign('sender');
            }
        );
    }
}
