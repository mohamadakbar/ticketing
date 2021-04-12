<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sts = Status::all();
        return view('status/list_status', ['status' => $sts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        Status::create([
            'name' => $request->name
        ]);

        return redirect('status')->with('alert-success', 'Success save data');
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
    public function edit($id)
    {
        $sts    = Status::find($id);
        return response()->json(['id'=>$sts->id, 'name' => $sts->name], '200');;
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

        $sts        = Status::find($request->id);
        $sts->name  = $request->name;

        if ($sts->save()){
            return response()->json(['alert-success' => 'success', 'name' => $sts->name, 'id' => $sts->id], 200);
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
        $sts    = Status::find($id);
        $sts->delete();
        return redirect('status')->with('alert-danger', 'Data has been deleted ');
    }
}
