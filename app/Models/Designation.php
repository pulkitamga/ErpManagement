<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Staff;
class Designation extends Model
{
    use HasFactory;

  
    public function Staff()
    {
        return $this->hasMany(Staff::class);
    }
   
}
