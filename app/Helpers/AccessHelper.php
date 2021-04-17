<?php
namespace App\Helpers;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

class AccessHelper{
    public static function get_access($id){
        $access = DB::table('akses')
            ->join('detailakses', 'akses.id', '=', 'detailakses.id_akses')
            ->join('menu', 'detailakses.id_menu', '=', 'menu.id')
            ->join('users', 'akses.id_user', '=', 'users.id')
            ->select('menu.id', 'menu.nama_menu', 'menu.slug', 'menu.parent', 'menu.child', 'menu.icon')
            ->where('users.id', $id)
            ->get();

        return $access;
    }

//    public static function user_status($id){
//        $user   = User::find($id);
//        $sts    = $user->status;
//
//        if ($sts == '0'){
//            Auth::logout();
//            return redirect('/')->with('alert-success', 'Your account is not active, please contact your administrator');
//        }
//    }
}

?>
