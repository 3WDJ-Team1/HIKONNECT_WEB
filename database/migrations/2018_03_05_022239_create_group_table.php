<?php
/**
 * PHP version 7.0
 * 
 * @category Migration
 * @package  Global
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3wdj-team1/HIKONNECT_WEB
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration file for create group table
 * 
 * @category Migration
 * @package  Global
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3wdj-team1/HIKONNECT_WEB
 */
class CreateGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'group', 
            function (Blueprint $table) {
                $table->uuid('uuid')->primary();
                $table->char('group_name', 20)->not_null();
                $table->uuid('group_owner')->references('uuid')->on('user');
                $table->char('mountain', 20)->not_null();
                $table->char('starting_point', 20)->not_null();
                $table->text('stopover')->not_null();
                $table->char('destination', 20)->not_null();
                $table->dateTime('start_date')->not_null();
                $table->unsignedDecimal('min_grouper', 10);
                $table->unsignedDecimal('max_grouper', 10);
                $table->timestamps();
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
        Schema::dropIfExists('group');
    }
}
