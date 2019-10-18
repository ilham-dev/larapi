<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class helper extends Model
{
    public static function GenerateNomorPelanggan(){
        $kode_user = "CMS-".date("ymd").rand(100000000, 999999999)."-ATT";
        return $kode_user;
    }

    public static function GenerateNomorTransaksi($kode = "UMH"){
        $notrans = 'ATT-'.$kode.'-' . random_int(100000000, 999999999) . date('ymds');
        return $notrans;
    }

    public static function GenerateNomorPembayaran(){
        $no_bukti = "B-ATT-".date("ymis").str_random(5);
        return $no_bukti;
    }

    public static function GenerateNomorMutasiSaldo(){
        $no_bukti = "ATT".date('ym').rand(100,999).Auth::user()->id."MTS";
        return $no_bukti;
    }

    public static function markupPersentaseKamar($harga, $persen)
    {
        $hasil_persentase = ($harga*$persen)/100;
        return $harga + $hasil_persentase;
    }

    public static function uploadfile($images, $name, $path)
    {
        $image = $images;
        if ($image->getSize() > 100000000){
            return false;
        }
        $extension = strstr($image->getClientOriginalName(), '.');
        $fileName = $name.$extension;
        $image->move($path, $fileName);

        return $fileName;
    }

    public static function seo($string){
        $nama_lowcase = strtolower($string);
        $seo = str_replace(" ", "-", $nama_lowcase);

        return $seo;
    }

    public static function sendSMS($toNumber, $smsMessages){

        $smsResult = infobip_sms_send($toNumber, $smsMessages);
        return $smsResult;
    }
}