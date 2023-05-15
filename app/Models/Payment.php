<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;



class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'season_id', 'payment', 'client_secret', 'status', 'expire_on'];

    protected $appends = ['user_name','invoice'];

    public function getCreatedDateAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
    public function User()
    {
        return $this->belongsToMany(User::class);
    }
    public function getUserNameAttribute()
    {
       $name = User::where('id',$this->user_id)->value('name');
       if($name){
        return ucwords($name);
       }else{
        return '';
       }
    }
    public function getInvoiceAttribute()
    {
        $t = $this->created_at->format('y-m-d H:i');
      return $t;
    }

}
