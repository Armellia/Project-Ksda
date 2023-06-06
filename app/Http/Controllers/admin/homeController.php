<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin;
use App\Models\LK;
use App\Models\resort;
use App\Models\satwa;
use App\Models\serahterima;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class homeController extends Controller
{
    public function index(){
        $data=LK::all();
        $count=$data->count();
        $data4=resort::all();
        $count4=$data4->count();
        $data1=Satwa::all();
        $count1=$data1->count();
        $data2=serahterima::all();
        $count2=$data2->count();
        $array=[$count4,$count,$count1,$count2];
        $user=User::find(Auth::user()->id);
        $dataAdmin=$user->admin;
        return view('admin.home',['data'=>$array,'admin'=>$dataAdmin]);
    }
    public function user(){
        
        $data=resort::all();
        $user=User::find(Auth::user()->id);
        $dataAdmin=$user->admin;
        return view('admin.user',['data'=>$data,'admin'=>$dataAdmin]);
    }
    public function tambahuser(Request $request){
        $user=User::where('username',$request->username)->count();
        if ($user>0) {
            return redirect()->route('resort')->with('salah','Username telah ada');
        }
        
        User::create([
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'role'=>'resort'
        ]);
        $id=User::all()->last();
        resort::create([
            'user_id'=>$id->id,
            'namaResort'=>$request->namaResort,
            'alamatResort'=>$request->alamatResort,
            'noTelpresort'=>$request->noTelpresort
        ]);
        return redirect()->route('resort');
        
    }
    public function edituser(Request $request){
        
        $resort=resort::find($request->idResort);
        $resort->namaResort=$request->namaResort;
        $resort->alamatResort=$request->alamatResort;
        $resort->noTelpresort=$request->noTelpresort;
        $resort->save();
        return redirect()->route('resort');
    }
    public function hapususer($id){
        
        $resort=resort::find($id);
        $id=$resort->user_id;
        $resort->delete();
        $user=User::find($id);
        $user->delete();
        return redirect()->route('resort');
    }
    public function user2(){
        $data=LK::all();
        
        $user=User::find(Auth::user()->id);
        $dataAdmin=$user->admin;
        return view('admin.user2',['data'=>$data,'admin'=>$dataAdmin]);
    }
    public function tambahuser2(Request $request){
        
        lk::create([
            'namaLK'=>$request->namaLK,
            'alamatLK'=>$request->alamatLK,
            'noTelpLK'=>$request->noTelpLK
        ]);
        
        
        return redirect()->route('lk');
    }
    public function edituser2(Request $request){
        
        $resort=LK::find($request->idLK);
        $resort->namaLK=$request->namaLK;
        $resort->alamatLK=$request->alamatLK;
        $resort->noTelpLK=$request->noTelpLK;
        $resort->save();
        return redirect()->route('lk');
    }
    public function hapususer2($id){
        
        $lk=LK::find($id);
        
        $lk->delete();
        return redirect()->route('lk');
    }
    public function satwa(){
        $data=satwa::all();
        $user=User::find(Auth::user()->id);
        $dataAdmin=$user->admin;
        return view('admin.satwa',['data'=>$data,'admin'=>$dataAdmin]);
    }
    public function getResort(Request $request){
        $user=resort::find($request->id);
        return json_encode($user);
    }
    public function getLK(Request $request){
        $user=lk::find($request->id);
        return json_encode($user);
    }
    public function satwaserahan(){
        $dataSemua=DB::table('resort_satwa')
        ->join('resorts','resort_satwa.resort_id','=','resorts.id')
        ->join('satwas','resort_satwa.satwa_id','=','satwas.id')
        ->join('lks','resort_satwa.lk_id','=','lks.id')
        ->select('resorts.*','satwas.*','lks.*','resort_satwa.*')
        ->get();
        $user=User::find(Auth::user()->id);
        $dataAdmin=$user->admin;
        return view('admin.serahsatwa',['dataSemua'=>$dataSemua,'admin'=>$dataAdmin]);
    }    
    public function editProfile(Request $request){
        $user=admin::find($request->idAdmin);
        $user->namaAdmin=$request->namaAdmin;
        $user->alamat=$request->alamatAdmin;
        $user->noTelp=$request->noTelpadmin;
        $user->save();
        return redirect()->route('profileadmin');
    }
    public function editPassword(Request $request){
        $request->validate([

            'password' => ['required'],

            'passwordbaru' => ['required'],
        ]);
        if(Hash::check($request->password, Auth::user()->password)){
            User::find(Auth::user()->id)->update(['password'=> Hash::make($request->passwordbaru)]);
            return redirect()->route('profileadmin');
        }
        else{
            $message="Password Salah";
            return redirect()->route('profileadmin')->with('jsAlert', $message);
        }
        
    }
    public function profile(){
        $user=User::find(Auth::user()->id);
        $dataAdmin=$user->admin;
        return view('admin.editprofile',['admin'=>$dataAdmin]);
    }
    public function getProfile(Request $request){
        $user=User::find($request->id);
        $dataAdmin=$user->admin;
        return json_encode($dataAdmin);
    }
}
