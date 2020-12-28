<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class equipe extends Model
{
    protected $table = "equipe";

    protected $fillable = ['id', 'libelle', 'createdOn','agenceId']; 
}
