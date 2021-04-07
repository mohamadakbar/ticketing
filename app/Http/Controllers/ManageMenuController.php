<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class ManageMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $menu       = Menu::all();
        return view('menu.list_menu',['menu' => $menu]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pattern    = Menu::pattern();
        return view('menu.create_menu', ['pattern' => $pattern]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_menu' => 'required',
            'slug'      => 'required',
            'parent'    => 'required',
            'child'     => 'required',
            'func'      => 'required|numeric',
            'icon'      => 'required'
        ]);

        Menu::create([
            'nama_menu' => $request->nama_menu,
            'slug'      => $request->slug,
            'parent'    => $request->parent,
            'child'     => $request->child,
            'func'      => $request->func,
            'icon'      => $request->icon,
        ]);

        return redirect('menu')->with('alert-success', 'Success save data');
    }

    public function show($id)
    {
        $show           = Menu::find($id);
        $pattern        = Menu::pattern();
        $pattern_detail = Menu::pattern_detail($show->child);
        return view('menu.detail_menu', ['show' => $show, 'pattern_detail' => $pattern_detail, 'pattern' => $pattern]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama_menu' => 'required',
            'slug'      => 'required',
            'parent'    => 'required',
            'child'     => 'required',
            'icon'      => 'required'
        ]);

        $menu   = Menu::find($id);
        $menu->nama_menu    = $request->nama_menu;
        $menu->slug         = $request->slug;
        $menu->parent       = $request->parent;
        $menu->child        = $request->child;
        $menu->icon         = $request->icon;
        $menu->save();

        return redirect('menu')->with('alert-warning', 'Success edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu   = Menu::find($id);
        $menu->delete();
        return redirect('menu')->with('alert-danger', 'Data has been deleted ');
    }
}
