<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTeam extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','leauge_id','season_id','week','team_id','points'];
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
