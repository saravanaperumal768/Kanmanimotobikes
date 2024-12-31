<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; // Import the Model class

class formdata extends Model
{
    
    protected $table = 'contactform';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'mobile', 'services', 'vehicle'];
}
