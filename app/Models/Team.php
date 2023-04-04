<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable =['name','logo','match_played','win','loss','status'];
    protected $appends = ['image'];

    public function getImageAttribute() {
        // $image = env('APP_URL').'/storage/images/team_logo'.$this->logo;
        // return $image;

        if (($this->logo !== null)) {
            return url('/storage/images/team_logo/'.$this->logo);
        } else {
            return url('/dist/images/dummy_image.webp');
        }
    }

    public function fixture_team_one()
    {
        return $this->hasMany(Fixture::class ,'team_one' , 'id' );
    }
    public function fixture_team_two()
    {
        return $this->hasMany(Fixture::class ,'team_two' , 'id' );
    }

    public function team_result_one()
    {
        return $this->hasMany(TeamResult::class ,'team1_id' , 'id' );
    }
    public function team_result_two()
    {
        return $this->hasMany(TeamResult::class ,'team2_id' , 'id' );
    }
    public function leaderboard()
    {
        return $this->hasOne(Leaderboard::class, 'id');
    }


}
