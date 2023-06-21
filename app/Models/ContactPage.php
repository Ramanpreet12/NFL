<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    use HasFactory;
    protected $table = 'contact_pages';
    protected $fillable = ['section_heading' , 'location_heading' , 'contact_page_content' , 'contact_page_image' ,'contact_form_heading', 'social_links_heading' , 'status'];

}
