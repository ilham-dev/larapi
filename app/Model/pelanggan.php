<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class pelanggan extends Model
{
    protected $table = "pelanggan";

    protected $fillable = [
        "kode_user",
        "email",
        "telepon",
        "passwords",
        "jk",
        "encrypted_password",
        "nama_depan",
        "nama_belakang",
    ];

    public static function getDeposit()
    {
        return self::select('saldo')->where('kode_user',Auth::user()->mitra_id)->first()->saldo;
    }

    public static function profileNama($kode_user)
    {
        $data = self::select('nama_depan','nama_belakang')->where('kode_user',$kode_user)->first();
        if(!empty($data))
        {
            return $data->nama_depan." ".$data->nama_belakang;
        }else{
            return "";
        }
    }

    public static function profileTelepon($kode_user)
    {
        $data = self::select('telepon')->where('kode_user',$kode_user)->first();
        if(!empty($data))
        {
            return $data->telepon;
        }else{
            return "";
        }
    }
}