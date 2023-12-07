<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
 
    protected $fillable = ['title', 'description', 'due_date', 'client_id', 'designer_id', 'is_complete'];

    public function getDueDateAttribute($value)
    { 
        return date('d-m-Y', strtotime($value));
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function designer() {
        return $this->hasOne(User::class, 'id', 'designer_id');
    } 
}
