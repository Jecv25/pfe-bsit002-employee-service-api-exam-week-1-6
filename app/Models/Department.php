<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Department extends Model
{
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}