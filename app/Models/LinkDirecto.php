<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkDirecto extends Model
{
    public $timestamps = false;
    protected $table = "links_directos";
    protected $primaryKey = 'id';


    protected $fillable = ['descripcion','uri'];

}
