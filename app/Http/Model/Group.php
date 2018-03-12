<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $table = 'hiking_group';

    /**
     * Get groupOwner, max_members, min_members from database
     * 
     * @return Array
     */
    public function getGroupInformations(int $pageIndex, int $perPage) 
    {
        return $allGroupInfo = Group::
        join(
            'recruitment', 
            'hiking_group.uuid',
            '=', 
            'recruitment.hiking_group'
        )
        ->join(
            'hiking_plan', 
            'recruitment.hiking_group', 
            '=', 
            'hiking_plan.hiking_group'
        )
        ->select(
            'recruitment.title',
            'hiking_plan.end_point',
            'hiking_group.owner',
            'hiking_plan.start_date',
            'hiking_group.max_members',
            'hiking_group.min_members'
        )
        ->skip($pageIndex)->take($perPage)->get();
    }

    /**
     * Get current application people from database
     * 
     * @return Array
     */
    public function getCountOfPeople() 
    {
        $countOfPeople     = DB::table('entry_info')
                             ->select(hiking_group, DB::raw('count(*) as total'))
                             ->groupBy('hiking_group')
                            ->get();
        return $countOfPeople;
    }
}
