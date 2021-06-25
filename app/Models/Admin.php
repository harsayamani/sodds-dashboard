<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'username';
    protected $fillable = ['username','password', 'name'];
    protected $hidden = ['password'];
    public $incrementing = false;

    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = bcrypt($value);
    }
}
