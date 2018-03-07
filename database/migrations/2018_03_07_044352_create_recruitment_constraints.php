<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentConstraints extends Migration
{
    private $_table = 'recruitment';

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
                $table->foreign('hiking_group')
                    ->references('uuid')->on('hiking_group')
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
                $table->dropForeign('hiking_group');
            }
        );
    }
}
