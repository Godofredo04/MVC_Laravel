<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Article extends Model
{
    use HasFactory;
    protected $table = 'articulos';
    protected $primaryKey = 'id_art';
    protected $fillable = array('id_art', 'titulo', 'cuerpo');
}
