<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPageImages extends Model
{
    use HasFactory;
    protected $table = 'about_pages_images';
    protected $fillable = ['about_page_id' , 'about_images'];

    public function aboutPage()
    {
    return $this->belongsTo(AboutPage::class , 'about_page_id' , 'id');
    }
}
