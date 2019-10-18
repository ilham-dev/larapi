<?php

namespace App\Http\Controllers\v1;

use App\Model\JsonStatus;
use App\Model\pelanggan;
use App\Model\pelanggan_alamat;
use App\Model\pelanggan_bank;
use App\Model\pelanggan_profil;
use App\Model\v_users;
use App\Model\Validate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function forUser()
    {
        $data = v_users::usersdetail(Auth::user()->id);
        return JsonStatus::messagewithData(200, 'Berhasil', $data);
    }

    public function fullinfo()
    {
        $data = v_users::usersdetail(Auth::user()->id);
        return JsonStatus::messagewithData(200, 'Berhasil', $data);
    }

}