<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\User;
use App\Models\DetailAkses;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::all();
        return view('user/user_list', ['user' => $user]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $show   = User::find($id);
        return view('user.detail_user', ['show' => $show]);
    }

    public function edit($id)
    {
        //
    }

    public function role($id)
    {
        $user_role  = User::role_user($id);
        $user_all   = User::find($id);
        $menu       = Menu::all();
        $list       = explode(' ', $user_all->name );
        return view('user.role_user', ['user_role' => $user_role, 'menu' => $menu, 'name' => $list, 'detail' => $user_all]);
    }

    public function update_role(Request $request)
    {
        $check      = $request->checklist;
        $id_akses   = $request->id_akses;
        $count      = count($check);
        DetailAkses::where('id_akses', $id_akses)->delete();

        for ($i=0; $i<$count; $i++){
            DetailAkses::create([
                'id_akses'	=> $id_akses,
                'id_menu' 	=> $check[$i]
            ]);
        }
        return redirect('/user');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'email'      => 'required',
            'status'    => 'required'
        ]);

        $user           = User::find($id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->status   = $request->status;
        $user->save();

        return redirect('/user')->with('alert-warning', 'Success edit data');
    }

    public function destroy($id)
    {
        $user   = User::find($id);
        $user->delete();

        return redirect('user')->with('alert-danger', 'User has been deleted ');
    }
}
