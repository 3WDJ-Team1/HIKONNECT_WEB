<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHikingRecordTable extends Migration
{
    private $_table = 'hiking_record';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'hiking_record',
            function (Blueprint $table) {
                $table->uuid('uuid')->primary();
                $table->uuid('owner');
                $table->uuid('hiking_plan');
                $table->decimal('avg_speed', 5, 2);
                $table->smallInteger('rank')->unsigned();
                $table->timestamps();
            }
        );

        if (Schema::hasTable($this->_table)) {
            DB::unprepared(
                '
                CREATE TRIGGER before_insert_hiking_record
                BEFORE INSERT ON hiking_record
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
