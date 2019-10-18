<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Validator;

class Validate extends Model
{

    public static function detailumrah($request){
        $validator = Validator::make($request->all(), [
            'kode_produk' => 'required',
        ]);
        return $validator;
    }

    public static function margin($request){
        $validator = Validator::make($request->all(), [
            'kode_tiket' => 'required',
            'kode_la' => 'required',
            'kode_visa' => 'required',
            'kode_asuransi' => 'required',
            'pax' => 'required',
            'margin' => 'required',
        ]);
        return $validator;
    }

    public static function informasi($request){
        $validator = Validator::make($request->all(), [
            'kode_tiket' => 'required',
            'kode_la' => 'required',
            'kode_visa' => 'required',
            'kode_asuransi' => 'required',
            'pax' => 'required',
        ]);
        return $validator;
    }

    public static function createumrah($request){
        $validator = Validator::make($request->all(), [
            'kode_tiket' => 'required',
            'kode_la' => 'required',
            'kode_visa' => 'required',
            'kode_asuransi' => 'required',
            'pax' => 'required',
            'margin' => 'required',
            'nama_produk' => 'required',
            'gambar' => 'required',
            'tgl_mulai' => 'required|date|date_format:Y-m-d|before:tgl_akhir',
            'tgl_akhir' => 'required|date|date_format:Y-m-d|after:tgl_mulai',
        ]);
        return $validator;
    }

    public static function transaksiumroh($request){
        $validator = Validator::make($request->all(), [
            'kode_produk' => 'required',
            'quad' => 'required',
            'triple' => 'required',
            'double' => 'required',
            'nama_pemesan' => 'required',
            'nomor_handphone' => 'required',
        ]);
        return $validator;
    }

    public static function transaksiall($request){
        $validator = Validator::make($request->all(), [
            'kode_produk' => 'required',
            'nama_pemesan' => 'required',
            'nomor_handphone' => 'required',
            'jenis_transaksi' => Rule::in(['LA', 'TIKET','VISA','ASURANSI','HANDLING','MANASIK','PERLENGKAPAN']),
        ]);
        return $validator;
    }

    public static function transaksila($request){
        $validator = Validator::make($request->all(), [
            'quad' => 'required|numeric',
            'triple' => 'required|numeric',
            'double' => 'required|numeric',
        ]);
        return $validator;
    }

    public static function transaksitiket($request){
        $validator = Validator::make($request->all(), [
            'dewasa' => 'required|numeric',
            'anak' => 'required|numeric',
            'bayi' => 'required|numeric',
        ]);
        return $validator;
    }

    public static function transaksi($request){
        $validator = Validator::make($request->all(), [
            'pax' => 'required|numeric',
        ]);
        return $validator;
    }

    public static function pembayaran($request){
        $validator = Validator::make($request->all(), [
            'nomor_transaksi' => 'required',
            'metode_pembayaran' => 'required',
            'jenis_pembayaran' => 'required',
            'bayar' => 'required',
        ]);
        return $validator;
    }

    public static function pembayaranTransfer($request){
        $validator = Validator::make($request->all(), [
            'kode_bank' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        return $validator;
    }

    public static function searchumrah($request){
        $validator = Validator::make($request->all(), [
            'jumlah' => 'required',
            'tenor' => 'required',
            'alasan' => 'required',
        ]);
        return $validator;
    }

    public static function nomor_transaksi($request){
        $validator = Validator::make($request->all(), [
            'nomor_transaksi' => 'required',
        ]);
        return $validator;
    }

    public static function editakun($request){
        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'tanggal_lahir' => 'required|date|date_format:Y-m-d',
            'jenis_kelamin' => Rule::in(['L','P']),
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        return $validator;
    }

    public static function register($request){
        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'telepon' => 'required|numeric',
            'email' => 'required|email',
            'password' => 'required',
            're_password' => 'required',
        ]);
        return $validator;
    }
}