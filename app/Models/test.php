<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class test extends Model
{
	protected $table = 'location_memo';

	public function testInsert(Array $test) {
        test::insert($test);
    }
}
?>