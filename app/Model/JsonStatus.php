<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JsonStatus extends Model
{
    public static function message($status_code, $message){
        return response()->json(['status_code'=> $status_code, 'message' => $message]);
    }

    public static function messagewithurl($status_code, $message, $url){
        return response()->json(['status_code'=> $status_code, 'message' => $message, 'url' => $url]);
    }

    public static function messagewithId($status_code, $message, $id){
        return response()->json(['status_code'=> $status_code, 'message' => $message, 'id' => $id]);
    }

    public static function messagewithurlId($status_code, $message, $url, $id){
        return response()->json(['status_code'=> $status_code, 'message' => $message, 'url' => $url, 'id' => $id]);
    }

    public static function messagewithData($status_code, $message, $data){
        return response()->json(['status_code'=> $status_code, 'message' => $message, 'data' => $data]);
    }

    public static function messagewithData2($status_code, $message, $data, $data2){
        return response()->json(['status_code'=> $status_code, 'message' => $message, 'data' => $data, 'data2' => $data2]);
    }

    public static function messagewithDataSession($status_code, $message, $data, $session){
        return response()->json(['status_code'=> $status_code, 'message' => $message, 'data' => $data,'session'=> $session]);
    }

    public static function messagewithView($status_code, $message, $data, $view){
        return response()->json(['status_code'=> $status_code, 'message' => $message, 'data' => $data, 'view' => view($view, compact('data'))->render()]);

    }

    public static function messagewithViewData($status_code, $message, $data, $view){
        return response()->json(['status_code'=> $status_code, 'message' => $message, 'data' => $data, 'view' => view($view, $data)->render()]);

    }

    public static function messagewithViewUrl($status_code, $message, $url, $view){
        return response()->json(['status_code'=> $status_code, 'message' => $message, 'url' => $url, 'view' => view($view)->render()]);

    }

    public static function messageException($exception){
        return response()->json(['status_code'=>500, 'message'=>'Terjadi Kesalahan Pada Sistem '.$exception->getMessage().' File '.$exception->getFile().' Line '.$exception->getLine()]);
//        return response()->json(['status_code'=>400, 'message'=>'Terjadi Kesalahan Pada Sistem :(']);
    }

    public static function responseData($status_code, $data){
        return response()->json(['status_code'=> $status_code, 'data' => $data]);
    }
}
