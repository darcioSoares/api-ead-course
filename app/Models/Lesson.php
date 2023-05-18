<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'video'];

    public function supports()
    {
        return $this->hasMany(Support::class);
    }

    
}//end class
