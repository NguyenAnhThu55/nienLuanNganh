<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vistor extends Model
{
    public $timestamps = false;
    protected $fillable = [
       'ip_address','date_visitor'
    ];
    protected $primaryKey = 'id_visitors';
    protected  $table = 'tbl_visitor';
}
