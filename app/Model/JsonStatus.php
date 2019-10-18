<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JsonStatus extends Model
{
    public static function message($status, $msg){
        return response()->json(['status'=> $status, 'msg' => $msg]);
    }

    public static function messagewithurl($status, $msg, $url){
        return response()->json(['status'=> $status, 'msg' => $msg, 'url' => $url]);
    }

    public static function messagewithId($status, $msg, $id){
        return response()->json(['status'=> $status, 'msg' => $msg, 'id' => $id]);
    }

    public static function messagewithurlId($status, $msg, $url, $id){
        return response()->json(['status'=> $status, 'msg' => $msg, 'url' => $url, 'id' => $id]);
    }

    public static function messagewithData($status, $msg, $data){
        return response()->json(['status'=> $status, 'msg' => $msg, 'data' => $data]);
    }

    public static function messagewithData2($status, $msg, $data, $data2){
        return response()->json(['status'=> $status, 'msg' => $msg, 'data' => $data, 'data2' => $data2]);
    }

    public static function messagewithDataSession($status, $msg, $data, $session){
        return response()->json(['status'=> $status, 'msg' => $msg, 'data' => $data,'session'=> $session]);
    }

    public static function messagewithView($status, $msg, $data, $view){
        return response()->json(['status'=> $status, 'msg' => $msg, 'data' => $data, 'view' => view($view, compact('data'))->render()]);

    }

    public static function messagewithViewData($status, $msg, $data, $view){
        return response()->json(['status'=> $status, 'msg' => $msg, 'data' => $data, 'view' => view($view, $data)->render()]);

    }

    public static function messagewithViewUrl($status, $msg, $url, $view){
        return response()->json(['status'=> $status, 'msg' => $msg, 'url' => $url, 'view' => view($view)->render()]);

    }

    public static function messageException($exception){
        return response()->json(['status'=>500, 'msg'=>'Terjadi Kesalahan Pada Sistem '.$exception->getMessage().' File '.$exception->getFile().' Line '.$exception->getLine()]);
//        return response()->json(['status'=>400, 'msg'=>'Terjadi Kesalahan Pada Sistem :(']);
    }

    public static function responseData($status, $data){
        return response()->json(['status'=> $status, 'data' => $data]);
    }
}
