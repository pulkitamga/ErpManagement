<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Designation;
class Staff extends Model
{
    use HasFactory;
    protected $fillable=[
        'username',
        'first_name',
        'last_name',
        'email',
        'shift',
        'designation_id',
        'salary',
        'status',
        
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
    
    
    
    

}