<?php
namespace App\Http\Controllers\v1;
use App\Model\helper;
use App\Model\JsonStatus;
use App\Model\pelanggan;
use App\Model\role_users;
use App\Model\v_users;
use App\Model\Validate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    public function redirectToProvider()
    {
        return Socialite::driver('github')->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->stateless()->user();

        // $user->token;
        dd($user);
    }

    public function forUser(){
        $data = v_users::usersdetail(Auth::user()->id);
        return JsonStatus::messagewithData(200,'Berhasil',$data);
    }

    public function logout(){
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);
        $accessToken->revoke();

        return JsonStatus::message(200,"Berhasil Logout");
    }

    public function register(Request $request){

        $validate = Validate::register($request);
        if ($validate->fails()){
            return JsonStatus::messagewithData(400,"Bad Request",$validate->errors());
        }

        // Generate Kode User
        $kode_user = helper::GenerateNomorPelanggan();
        $password = Hash::make($request->password);

        // Cek User Avaliabe
        $cek = pelanggan::select('nama_depan')->where('email',$request->email)->orwhere('telepon',$request->telepon)->first();
        if (!empty($cek)){
            return JsonStatus::message(400,"Data User Sudah Ada sebelumnya");
        }

        // Cek Password
        if($request->password != $request->re_password)
        {
            return JsonStatus::message(400,'Password anda tidak sama');
        }

        try{
            DB::begintransaction();
            $model = $request->input();
            $model['kode_user'] = $kode_user;
            $model['passwords'] = $password;
            $model['password'] = $password;
            $model['encrypted_password'] = $password;
            $model['role'] = "CMS";
            $model['name'] = $request->nama_depan." ".$request->nama_belakang;
            $model['is_active'] = "1";

            pelanggan::create($model);

            $users = User::create($model);
            $user['user_id'] = $users->id;
            $user['role_id'] = 10;
            role_users::create($user);

        }catch (\Exception $exception){
            DB::rollback();
            return JsonStatus::messageException($exception);
        }
        DB::commit();
        return JsonStatus::message(200,"Berhasil Registrasi");
    }

}