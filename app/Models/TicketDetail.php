<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TicketDetail extends Model
{
    protected $table = 'ticket_detail';

    protected $fillable = ['comment', 'ticket_id', 'category_id', 'status_id', 'user_id'];

    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
