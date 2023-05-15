<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class Fixture extends Model
{
    use HasFactory;
    protected $table = 'fixtures';
    protected $fillable = ['season_id', 'first_team', 'second_team', 'week', 'date', 'time', 'time_zone'];

protected $appends = ['name_team'];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function first_team_id()
    {
        return $this->belongsTo(Team::class, 'first_team', 'id');
    }
    public function second_team_id()
    {
        return $this->belongsTo(Team::class, 'second_team', 'id');
    }
    public function getNameTeamAttribute()
    {
       $rr = DB::table('teams')->where('id',$this->first_team)->value('name');
       return $rr;
    }
}
