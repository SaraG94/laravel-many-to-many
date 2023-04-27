<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'titolo',
        'cliente',
        'descrizione',
        'link',
        'slug',
        'type_id'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
        //questo progetto appartiene a Type
    }

    //definisco la relazione molti a molti
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    //metedo che prende gli id di tech.
    public function getTechIds()
    {
        return $this->technologies->pluck('id')->all();
    }
}
