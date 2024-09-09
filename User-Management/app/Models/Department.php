<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function consumer()
    {
        return $this->hasMany(Consumer::class, 'department_id');
    }
}
