<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentTable extends Migration
{
    private $_table = 'recruitment';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'recruitment', 
            function (Blueprint $table) {
                $table->uuid('uuid')->primary();
                $table->uuid('hiking_group');
                $table->string('title', 20);
                $table->string('content', 200);
                $table->unsignedBigInteger('hits')->default(0);
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