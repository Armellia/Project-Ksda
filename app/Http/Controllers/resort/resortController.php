<?php

namespace App\Http\Controllers\resort;

use App\Http\Controllers\Controller;
use App\Models\LK;
use App\Models\resort;
use App\Models\User;
use App\Models\Satwa;
use App\Models\satwa_user;
use App\Models\serahterima;
use App\Models\user2;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class resortController extends Controller
{
    public function index(){
        $data=User::find(Auth::user()->id);
        $user=$data->resort;
        $lk=LK::all();
        $satwa=Satwa::all();

        $dataSemua=DB::table('resort_satwa')
        ->join('resorts','resort_satwa.resort_id','=','resorts.id')
        ->join('satwas','resort_satwa.satwa_id','=','satwas.id')
        ->join('lks','resort_satwa.lk_id','=','lks.id')
        ->select('resorts.*','satwas.*','lks.*','resort_satwa.*','resort_satwa.id as idRS')
        ->where('resort_satwa.resort_id','=',$user->id)->get();

        return view('resort.dashboard',['user'=>$lk,'satwa'=>$satwa,'dataSemua'=>$dataSemua,'profile'=>$user]);
    }
    public function store(Request $request){
        $request->validate([
            'jumlah'=>'integer|min:0',
            'tanggalSerah'=>'date'
        ]);
        $newDate = date("Y-m-d", strtotime($request->tanggalSerah));

        serahterima::create([
        'resort_id'=>$request->resort_id,
        'lk_id'=>$request->lk_id,
        'satwa_id'=>$request->satwa_id,
        'jumlah'=>$request->jumlah,
        'noSerahterima'=>$request->noSerahterima,
        'tanggal'=>$newDate,
        ]);
        return redirect()->route('dashboardR');
    }
    public function tambahbaru(){
        $data=User::find(Auth::user()->id);
        $user=$data->resort;
        return view('resort.tambahbaru',['profile'=>$user]);
    }
    public function tambahbarustore(Request $request){
        if($request->filled('namaSatwa')){
        Satwa::create([
            'namaLatin'=>$request->namaLatin,
        'namaSatwa'=>$request->namaSatwa,
        'jenisSatwa'=>$request->jenisSatwa,
        'ordo'=>null,
        'keluarga'=>null
        ]);
    }
    if($request->filled('namaLK')){
        lk::create([
            'namaLK'=>$request->namaLK,
            'alamatLK'=>$request->alamatLK,
            'noTelpLK'=>$request->noTelpLK
        ]);
    }
        return redirect()->route('dashboardR');
    }
    public function update(Request $request){
        $request->validate([
            'jumlah'=>'integer|min:0'
        ]);
        $newDate = date("Y-m-d", strtotime($request->tanggalSerah));
        $update=serahterima::find($request->id);

        $update->resort_id=$request->resort_id;
        $update->lk_id=$request->lk_id;
        $update->satwa_id=$request->satwa_id;
        $update->jumlah=$request->jumlah;
        $update->noSerahterima=$request->noSerahterima;
        $update->tanggal=$newDate;
        $update->save();

        return redirect()->route('dashboardR');
    }
    public function editProfile(Request $request){
        $user=resort::find($request->idResort);
        $user->namaResort=$request->namaResort;
        $user->alamatResort=$request->alamatResort;
        $user->noTelpresort=$request->noTelpResort;
        $user->save();
        return redirect()->route('profileresort');
    }
    public function editPassword(Request $request){
        $request->validate([

            'password' => ['required'],

            'passwordbaru' => ['required'],
        ]);
        if(Hash::check($request->password, Auth::user()->password)){
            User::find(Auth::user()->id)->update(['password'=> Hash::make($request->passwordbaru)]);
            return redirect()->route('profileresort');
        }
        else{
            $message="Password Salah";
            return redirect()->route('profileresort')->with('jsAlert', $message);
        }

    }
    public function profile(){
        $user=User::find(Auth::user()->id);
        $dataResort=$user->resort;
        return view('resort.editprofile',['resort'=>$dataResort]);
    }
    public function getProfile(Request $request){
        $user=User::find(Auth::user()->id);
        $dataResort=$user->Resort;
        return json_encode($dataResort);
    }
    public function getDataserah(Request $request){
        $dataSemua=DB::table('resort_satwa')
        ->join('resorts','resort_satwa.resort_id','=','resorts.id')
        ->join('satwas','resort_satwa.satwa_id','=','satwas.id')
        ->join('lks','resort_satwa.lk_id','=','lks.id')
        ->select('resorts.*','satwas.*','lks.*','resort_satwa.*','resort_satwa.id as idRS')
        ->where('resort_satwa.id','=',$request->id)->get();
        return json_encode($dataSemua);
    }
}
