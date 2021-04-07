<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "status";

    protected $fillable = ['name'];

    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function ticketDetail()
    {
        return $this->hasMany('App\Models\TicketDetail');
    }

}
