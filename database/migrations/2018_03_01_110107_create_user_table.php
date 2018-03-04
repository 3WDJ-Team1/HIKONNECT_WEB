<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'user',
            function (Blueprint $table) {
                $table->uuid('uuid')->primary();
                $table->string('user_id', 40)->notNull();
                $table->string('password', 40)->notNull();
                $table->string('nickname', 10)->notNull();
                $table->string('user_photo_path', 100)->notNull();
                $table->char('phone', 15);
                $table->boolean('phone_isopen');
                $table->char('gender', 10);
                $table->boolean('gender_isopen');
                $table->char('age_group', 10);
                $table->boolean('age_group_isopen');
                $table->timestamps();
            }
        );

        DB::unprepared(
            '
            CREATE TRIGGER before_insert_user
            BEFORE INSERT ON user
            FOR EACH ROW
            BEGIN
            IF new.uuid LIKE "" THEN
                SET new.uuid = uuid();
            END IF;
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
        Schema::dropIfExists('user');
    }
}
