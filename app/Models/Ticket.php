<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    protected $table = "ticket";

    protected $fillable = ['user_id', 'category_id', 'status_id'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function ticketDetail()
    {
        return $this->hasMany('App\Models\TicketDetail');
    }
}
