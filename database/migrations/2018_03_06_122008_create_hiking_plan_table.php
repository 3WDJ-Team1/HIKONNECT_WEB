<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHikingPlanTable extends Migration
{
    private $_table = 'hiking_plan';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'hiking_plan', 
            function (Blueprint $table) {
                $table->uuid('uuid')->primary();
                $table->uuid('hiking_group');
                $table->datetime('start_date');
                $table->jsonb('starting_point');
                $table->jsonb('stopover');
                $table->jsonb('end_point');
                $table->timestamps();
            }
        );

        if (Schema::hasTable($this->_table)) {
            DB::unprepared(
                '
                CREATE TRIGGER before_insert_' . $this->_table . '
                BEFORE INSERT ON ' . $this->_table . '
                FOR EACH ROW
                BEGIN
                IF new.uuid LIKE "" THEN
                    SET new.uuid = uuid();
                END IF;
                END
                '
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('before_insert' . $this->_table);
        Schema::dropIfExists($this->_table);
    }
}
