<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Season;

class UserTeam extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','leauge_id','season_id','week','team_id','points'];

    protected $append = ['season_name'];
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function getSeasonNameAtrribute()
    {
        $season_name = Season::where('id',$this->team_id)->get();
        if($season_name){
            return $season_name->name;
        }else{
            return '';
        }
    }
}
