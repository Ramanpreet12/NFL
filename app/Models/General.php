<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;
    protected $table = 'generals';
    protected $fillable = ['name','email','homepage_title','homepage_subtitle' , 'logo' , 'favicon' , 'footer_contact' , 'footer_address' ,'footer_content'];
}
