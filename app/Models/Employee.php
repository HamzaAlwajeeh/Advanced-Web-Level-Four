<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    protected $guarded = ['id'];
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
