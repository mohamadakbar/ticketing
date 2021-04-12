<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Category::get();
        return view('cat/list_category', ['category' => $cat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name'      => 'required',
        ]);

        Category::create([
            'name'  => $request->name
        ]);

        return redirect('category')->with('alert-success', 'Success save data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $cat = Category::find($id);

        return response()->json(['cat'=>$cat],'200');;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name'      => 'required',
        ]);

        $cat        = Category::find($request->id);
        $cat->name  = $request->name;

        if ($cat->save()){
            return response()->json(['alert-success' => 'success', 'name' => $cat->name, 'id' => $cat->id], 200);
        }else{
            return response()->json(['status' => 500]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat   = Category::find($id);
        $cat->delete();
        return redirect('category')->with('alert-danger', 'Data has been deleted ');
    }
}
