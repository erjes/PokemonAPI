<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pokemonModel extends Model
{
    use HasFactory;

    protected $table = 'pokemon';

    protected $primaryKey = 'id';

    protected $fillable = ['nickname', 'name', 'front_default'];
}
