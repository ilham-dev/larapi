<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class v_users extends Model
{
    protected $table = "v_users";

    public static function usersdetail($id){
        $data = v_users::select('v_users.*','x_perusahaan.nama_vendor','pelanggan.nama_depan','pelanggan.nama_belakang','pelanggan.telepon','pelanggan.jk')
            ->leftjoin('x_perusahaan','x_perusahaan.kode_owner','v_users.mitra_id')
            ->join('pelanggan','pelanggan.kode_user','=','v_users.mitra_id')
            ->where('v_users.id',$id)
            ->first();
        return $data;
    }
}