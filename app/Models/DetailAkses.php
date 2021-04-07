<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Access;

class DetailAkses extends Model
{
    protected $table = "detailakses";

    protected $fillable = ['id_akses', 'id_menu'];

    public function akses()
    {
        return $this->hasMany('App\Models\Access');
    }
}
