<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class v_visa extends Model
{
    protected $table = "v_xvisa";

    public static function get($request){
        $data = self::select('*')
            ->when($request->input('program_hari'), function($query) use ($request){
                return $query->where('duration_stay', $request->input('program_hari'));
            })
            ->paginate($request->input('per_page') ? $request->input('per_page') : 8);

        return $data;
    }

    public static function detail($kode_produk){
        $data = self::select(
            'nama',
            'harga_jual',
            'nama_vendor',
            'deskripsi',
            'sk',
            'foto',
            'gambar',
            'duration_stay'
        )
            ->where('kode_produk',$kode_produk)->first();
        return $data;
    }
}