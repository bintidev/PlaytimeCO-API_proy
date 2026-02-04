<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toy extends Model
{
    
    protected $fillable = [
        "supervisor",
        "alias",
        "name",
        "subject",
        "status",
        "creation_date",
        "species"
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
