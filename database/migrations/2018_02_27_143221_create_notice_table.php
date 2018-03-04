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

        Schema::create(
            'notice', 
            function (Blueprint $table) {
                $table->uuid('uuid')->primary();
                $table->string('writer', 36)->references('uuid')->on('user');
                $table->string('content', 500);
                $table->char('notice_range', 20);
                $table->string('notice_for', 36);
                $table->timestamps();
            }
        );

        DB::unprepared(
            '
            CREATE TRIGGER before_insert_notice
            BEFORE INSERT ON notice
            FOR EACH ROW
            BEGIN
                SET new.uuid = uuid();
            END
            '
        );
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
