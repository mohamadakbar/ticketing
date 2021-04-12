<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = "menu";

    protected  $fillable = ['nama_menu', 'slug', 'parent', 'child', 'func', 'icon'];

    public static function pattern(){
        $pattern = DB::table('menu as a')
                    ->select('b.nama_menu', 'b.slug', 'b.child', 'b.id', 'b.parent')
                    ->join('menu as b', 'a.id', '=', 'b.parent')
                    ->get();

        return $pattern;
    }

    public static function pattern_detail($id){
        $pattern = DB::table('menu as a')
            ->select('b.nama_menu', 'b.slug', 'b.child', 'b.id' , 'b.parent')
            ->join('menu as b', 'a.id', '=', 'b.parent')
            ->where('b.id', $id)
            ->get();

        return $pattern;
    }
}
