<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\models\TicketDetail;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticket = Ticket::with(['category', 'user', 'status'])->get();
        return view('ticket/list_ticket', ['ticket' => $ticket]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id     = Auth::user()->id;
        $user   = User::find($id);
        $cat    = Category::all();
        return view('ticket/create_ticket', ['user' => $user, 'category' => $cat]);
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
            'user_id'       => 'required',
            'category_id'   => 'required',
            'comment'       => 'required'
        ]);

        $ticket = Ticket::create([
            'user_id'       => $request->user_id,
            'category_id'   => $request->category_id,
            'status_id'        => '1', // new ticket
        ]);
        $ticket_id = $ticket->id;
        TicketDetail::create([
            'ticket_id'   => $ticket_id,
            'user_id'       => $request->user_id,
            'status_id'        => '1', // new ticket
            'comment'       => $request->comment
        ]);
        return redirect('/ticket')->with('alert-success', 'Success insert data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show   = TicketDetail::where('ticket_id', $id)->with(['user', 'status'])->get();
//        dd($show);
        return view('ticket/detail_ticket', ['show' => $show]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $check = TicketDetail::where('status_id', '=', $request->sts_id, 'and')->where('ticket_id', '=', $id)->count();
//        dd($check);


        if (!$request->sts_id){
            TicketDetail::create([
                'ticket_id' => $id,
                'comment' => $request->comment,
//                'status_id' => $request->sts_id,
                'user_id' => $request->user_id
            ]);
        }else{
            if ($check >= 1){
                return redirect('ticket')->with('alert-warning', 'Status already in your ticket, check detail ticket');
            }
            $ticket   = Ticket::find($id);
            $ticket->status_id    = $request->sts_id;
            $ticket->save();

            TicketDetail::create([
                'ticket_id' => $id,
                'comment' => $request->comment,
                'status_id' => $request->sts_id,
                'user_id' => $request->user_id
            ]);
        }


        return redirect('ticket')->with('alert-success', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
