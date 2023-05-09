<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;

class Fixture extends Model
{
    use HasFactory;
    protected $table = 'fixtures';
    protected $fillable = ['season_id', 'first_team', 'second_team', 'week', 'date', 'time', 'time_zone'];



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

}
