<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('notice', function (Blueprint $table) {
            $table->char('join_id', 36)->primary();
            $table->string('reference', 100);
            $table->string('writer', 36);
            $table->string('contnet', 500);
            $table->char('notice_range', 20);
            $table->string('notice_for', 36);
        });

        DB::unprepared('
        CREATE TRIGGER before_insert_notice
        BEFORE INSERT ON notice
        FOR EACH ROW
        BEGIN
          IF new.join_id LIKE "" THEN
            SET new.join_id = uuid();
          END IF;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice');
    }
}
