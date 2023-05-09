<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TeamResult extends Model
{
    use HasFactory;
    protected $table = 'team_results';
    protected $fillable = ['fixture_id','team1_id', 'team2_id', 'team1_score', 'team2_score', 'result_status', 'status','win','loss'];

    protected $appends = ['team_one_status', 'team_two_status'];

    public function team_result_id1()
    {
        return $this->belongsTo(Team::class, 'team1_id', 'id');
    }
    public function team_result_id2()
    {
        return $this->belongsTo(Team::class, 'team2_id', 'id');
    }

    public function getTeamOneStatusAttribute()
    {
        $win =  DB::table('fixtures')->where('win', $this->team1_id)->first();
        if ($win) {
            return 'win';
        } else{
            return 'loss';
        }


    }
    public function getTeamTwoStatusAttribute()
    {

        $loss =  DB::table('fixtures')->where('loss', $this->team2_id)->first();
        if ($loss) {
            return 'loss';
        }else{
            return 'win';
        }
    }


}
