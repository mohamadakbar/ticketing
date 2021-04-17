<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function role_user($id)
    {
        $role = DB::table('akses')
                ->select('akses.id_user', 'akses.id', 'detailakses.id_menu', 'detailakses.id_akses', 'menu.nama_menu', 'menu.parent', 'menu.child')
                ->join('detailakses', 'akses.id', '=', 'detailakses.id_akses')
                ->join('menu', 'detailakses.id_menu', '=', 'menu.id' )
                ->join('users', 'users.id', '=', 'akses.id_user')
                ->where('users.id', $id)
                ->get();

        return $role;
    }

    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function ticketDetail()
    {
        return $this->hasMany('App\Models\TicketDetail');
    }

}
