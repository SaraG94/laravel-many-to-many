<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;
    
    //definisco la relazione molti a molti
    public function projects()
    {
        return $this->belongsToMany(Project::class);
        //questa technology appartiene a molti project
    }
}
