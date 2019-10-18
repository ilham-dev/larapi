<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Numbering extends Model
{
    public static function formatNominal($nominal)
    {
        $nominal = str_replace(['$','Rp.', '.',' ',','],'', $nominal);
        return $nominal;
    }

    public static function getNominal($nominal){
        $nominal = str_replace(['$','Rp.', '.',' ',','],'', $nominal);
        $nominal = substr($nominal,0,-2);
        return $nominal;
    }

    public static function getSeoText($text){
        $search  = array("\"","'","<",">","#","%","{","}"," ","|","/",'"','^','~','[',']','`',';','?',':','@','=','&');

        return str_replace($search,'-',strtolower($text));
    }

    public static function getAge($birthday){
        if(strpos($birthday,'/')== true){
            $pecah = explode('/', $birthday);
            //$birthday = "1992-05-22";
            $birthday = $pecah[2].'-'.$pecah[1].'-'.$pecah[0];

            // Convert Ke Date Time
            $biday = new \DateTime($birthday);
            $today = new \DateTime();

            $diff = $today->diff($biday);

            // Display
            //echo "Tanggal Lahir: ". date('d M Y', strtotime($birthday)) .'<br />';
            //echo "Umur: ". $diff->y ." Tahun";
            return $diff->y;
        }else{
            // Convert Ke Date Time
            $biday = new \DateTime($birthday);
            $today = new \DateTime();

            $diff = $today->diff($biday);

            // Display
            return $diff->y;
        }
    }

    public static function FormatTanggalDB($tanggal){
        if (strpos($tanggal,'-')== true){
            $tgl = explode('-', $tanggal);
        }elseif(strpos($tanggal,'/')== true){
            $tgl = explode('/', $tanggal);
        }else{
            return $tanggal;
        }
        if ($tgl[1] > 12){
            return $tgl[2].'-'.$tgl[0].'-'.$tgl[1];
        }elseif (strlen($tgl[0]) == 4){
            return $tanggal;
        }else{
            return $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
        }

    }

    public static function FormatTanggalDBMinusBulan($tanggal,$minus){
        if (strpos($tanggal,'-')== true){
            $tgl = explode('-', $tanggal);
        }elseif(strpos($tanggal,'/')== true){
            $tgl = explode('/', $tanggal);
        }else{
            return $tanggal;
        }
        if ($tgl[1] > 12){
            return $tgl[2].'-'.$tgl[0] - $minus.'-'.$tgl[1];
        }elseif (strlen($tgl[0]) == 4){
            return $tanggal;
        }else{
            return $tgl[2].'-'.$tgl[1] - $minus.'-'.$tgl[0];
        }

    }

    public static function FormatTanggalDBValid($tanggal){
        if (strpos($tanggal,'-')== true){
            $tgl = explode('-', $tanggal);
        }elseif(strpos($tanggal,'/')== true){
            $tgl = explode('/', $tanggal);
        }else{
            return $tanggal;
        }
        if ($tgl[1] > 12){
            return false;
        }else{
            return true;
        }

    }

    public static function NoUrut($no){
        if ( $no == 0 ) {
            $no = "00001";
        }else{
            $no++;
        }
        return sprintf("%05s", $no);
    }

    public static function NoUrutRekening($no){
        if ( $no == 0 ) {
            $no = "0001";
        }else{
            $no++;
        }
        return sprintf("%04s", $no);
    }

    public static function GenerateKodeBooking(){
        // UPDATED BY RAKA PRIYO

        /**
         * E-Booking
         */
        $kode_booking = "";
        $characters = array_merge(range('A','Z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 5; $i++) {
            $rand = mt_rand(0, $max);
            $kode_booking .= $characters[$rand];
        }
        $hasil_kode_booking = $kode_booking;

        // END UPDATED BY RAKA PRIYO
        return $hasil_kode_booking;
    }

    public static function GenerateKodeTiket(){
        // UPDATED BY RAKA PRIYO

        /**
         * E-Booking
         */
        $kode_booking = "";
        $characters = array_merge(range('A','Z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 6; $i++) {
            $rand = mt_rand(0, $max);
            $kode_booking .= $characters[$rand];
        }
        $hasil_kode_booking = $kode_booking;

        // END UPDATED BY RAKA PRIYO
        return $hasil_kode_booking;
    }

    public static function kodePoint(){
        $kode_booking = "";
        $characters = array_merge(range('A','Z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 5; $i++) {
            $rand = mt_rand(0, $max);
            $kode_booking .= $characters[$rand];
        }
        $hasil_kode_booking = "ABU".$kode_booking."POINT";
        return $hasil_kode_booking;
    }

    public static function kodePengajuanFee(){
        $kode_booking = "";
        $characters = array_merge(range('A','Z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 5; $i++) {
            $rand = mt_rand(0, $max);
            $kode_booking .= $characters[$rand];
        }
        $hasil_kode_booking = "FEE".$kode_booking;
        return $hasil_kode_booking;
    }

    public static function kodePengajuanPoint(){
        $kode_booking = "";
        $characters = array_merge(range('A','Z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 5; $i++) {
            $rand = mt_rand(0, $max);
            $kode_booking .= $characters[$rand];
        }
        $hasil_kode_booking = "POINT".$kode_booking;
        return $hasil_kode_booking;
    }

    public static function dateConvert($datetime, $full = false){
        $now = new \DateTime(Carbon::now('Asia/Jakarta'));
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public static function formattanggalindonesia($tanggal){
        if (strpos($tanggal,'-')== true){
            $tgl = explode('-', $tanggal);
        }elseif(strpos($tanggal,'/')== true){
            $tgl = explode('/', $tanggal);
        }
        //$tgl[1] = Option::getOneDataBytype($tgl[1],'nama','bulan');
        return $tgl[2].' '.$tgl[1].' '.$tgl[0];
    }
}