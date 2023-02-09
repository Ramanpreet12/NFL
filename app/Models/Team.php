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
        $image = env('APP_URL').'/storage/images/'.$this->logo;
        return $image;
    }

    public function fixture_team_one()
    {
        return $this->hasMany(Fixture::class ,'team_one' , 'id' );
    }
    public function fixture_team_two()
    {
        return $this->hasMany(Fixture::class ,'team_two' , 'id' );
    }
}
