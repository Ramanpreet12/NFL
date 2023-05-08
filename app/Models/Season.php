<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = ['name','league','starting','ending'];

    public function fixture(){
        return $this->hasMany(Fixture::class);
    }
}
