<?php

namespace App\Http\Controllers\perlindungan;

use App\Http\Controllers\Controller;
use App\Models\LK;
use App\Models\perlindungan;
use App\Models\resort;
use App\Models\satwa;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class perlindunganController extends Controller
{
    public function index(){
        $data=User::find(Auth::user()->id);
        $user=$data->perlindungan;
        $lk=LK::all();
        $resort=resort::all();
        $satwa=satwa::all();


        $dataSemua=DB::table('resort_satwa')
        ->join('resorts','resort_satwa.resort_id','=','resorts.id')
        ->join('satwas','resort_satwa.satwa_id','=','satwas.id')
        ->join('lks','resort_satwa.lk_id','=','lks.id')
        ->select('resorts.*','satwas.*','lks.*','resort_satwa.*','resort_satwa.id as idSerah')
        ->get();


        return view('lindung.dashboard',['dataSemua'=>$dataSemua,'profile'=>$user,'dataResort'=>$resort,'dataLK'=>$lk,'dataSatwa'=>$satwa]);
    }

    public function printSemua(Request $request){

        $dataSemua=DB::table('resort_satwa')
        ->join('resorts','resort_satwa.resort_id','=','resorts.id')
        ->join('satwas','resort_satwa.satwa_id','=','satwas.id')
        ->join('lks','resort_satwa.lk_id','=','lks.id');

        if ($request->filled('resort')) {
            $dataSemua->where('resort_satwa.resort_id',$request->resort);
        }
        else{}
        if ($request->filled('LK')) {
            $dataSemua->where('resort_satwa.lk_id',$request->LK);
        }
        else{}
        if ($request->filled('satwa')) {
            $dataSemua->where('resort_satwa.satwa_id',$request->satwa);
        }
        else{}
        if ($request->filled('bulan')) {
            $dataSemua->whereMonth('resort_satwa.tanggal',$request->bulan);
        }
        else{}
        if ($request->filled('tahun')) {
            $dataSemua->whereYear('resort_satwa.tanggal',$request->tahun);
        }
        else{}
        $query=$dataSemua->orderby('tanggal','ASC')->get();
        switch ($request->bulan) {
            case '1':
                $bulan="Januari";
                break;
            case '2':
                $bulan="Februari";
                break;
            case '3':
                $bulan="Maret";
                break;
            case '4':
                $bulan="April";
                break;
            case '5':
                $bulan="Mei";
                break;
            case '6':
                $bulan="Junia";
                break;
            case '7':
                $bulan="Juli";
                break;
            case '8':
                $bulan="Agustus";
                break;
            case '9':
                $bulan="Septmber";
                break;
            case '10':
                $bulan="Oktober";
                break;
            case '11':
                $bulan="November";
                break;
            case '12':
                $bulan="Desember";
                break;

            default:
                $bulan="";
                break;
        }
        if($request->filled('tahun')){
            $tahun=$request->tahun;
        }
        else{
            $tahun="";
        }


        return view('reports.reportall',[
            'data'=>$query,
            'tahun'=>$tahun,
            'bulan'=>$bulan,
            'bulan2'=>$request->bulan,
            'satwa'=>$request->satwa,
            'LK'=>$request->LK,
            'resort'=>$request->resort
            ]);
    }
    public function cetakSemua(Request $request){
        // dd($request->LK);
        $dataSemua=DB::table('resort_satwa')
        ->join('resorts','resort_satwa.resort_id','=','resorts.id')
        ->join('satwas','resort_satwa.satwa_id','=','satwas.id')
        ->join('lks','resort_satwa.lk_id','=','lks.id');
        if ($request->filled('resort')) {
            $dataSemua->where('resort_satwa.resort_id',$request->resort);
        }
        else{}
        if ($request->filled('LK')) {
            $dataSemua->where('resort_satwa.lk_id',$request->LK);
        }
        else{}
        if ($request->filled('satwa')) {
            $dataSemua->where('resort_satwa.satwa_id',$request->satwa);
        }
        else{}
        if ($request->filled('bulan')) {
            $dataSemua->whereMonth('resort_satwa.tanggal',$request->bulan);
        }
        else{}
        if ($request->filled('tahun')) {
            $dataSemua->whereYear('resort_satwa.tanggal',$request->tahun);
        }
        else{}
        $query=$dataSemua->orderBy('tanggal','ASC')->get();
        switch ($request->bulan) {
            case '1':
                $bulan="Januari";
                break;
            case '2':
                $bulan="Februari";
                break;
            case '3':
                $bulan="Maret";
                break;
            case '4':
                $bulan="April";
                break;
            case '5':
                $bulan="Mei";
                break;
            case '6':
                $bulan="Junia";
                break;
            case '7':
                $bulan="Juli";
                break;
            case '8':
                $bulan="Agustus";
                break;
            case '9':
                $bulan="Septmber";
                break;
            case '10':
                $bulan="Oktober";
                break;
            case '11':
                $bulan="November";
                break;
            case '12':
                $bulan="Desember";
                break;

            default:
                $bulan="Semua";
                break;
        }
        if($request->filled('tahun')){
            $tahun=$request->tahun;
        }
        else{
            $tahun="Semua";
        }


        $pdf = App::make('dompdf.wrapper');
        $pdf->loadview('cetak.cetaksemua',[
            'data'=>$query,
            'tahun'=>$tahun,
            'bulan'=>$bulan,
            'bulan2'=>$request->bulan,
            'satwa'=>$request->satwa,
            'LK'=>$request->LK,
            'resort'=>$request->resort
            ])->setPaper('a4','landscape');
        return $pdf->stream('Laporan_Bulan_'.$bulan.'_'.$tahun.'_'.date('d-m-Y'));
    }

    public function editProfile(Request $request){
        $user=perlindungan::find($request->idPerlindungan);
        $user->namaPerlindungan=$request->namaPerlindungan;
        $user->alamat=$request->alamatPerlindungan;
        $user->noTelp=$request->noTelpperlindungan;
        $user->save();
        return redirect()->route('profileperlindungan');
    }
    public function editPassword(Request $request){
        $request->validate([

            'password' => ['required'],

            'passwordbaru' => ['required'],
        ]);
        if(Hash::check($request->password, Auth::user()->password)){
            User::find(Auth::user()->id)->update(['password'=> Hash::make($request->passwordbaru)]);
            return redirect()->route('profileperlindungan');
        }
        else{
            $message="Password Salah";
            return redirect()->route('profileperlindungan')->with('jsAlert', $message);
        }

    }
    public function profile(){
        $user=User::find(Auth::user()->id);
        $dataPerlindungan=$user->perlindungan;
        return view('lindung.editprofile',['perlindungan'=>$dataPerlindungan]);
    }
    public function getProfile(Request $request){
        $user=User::find(Auth::user()->id);
        $dataPerlindungan=$user->perlindungan;
        return json_encode($dataPerlindungan);
    }
    public function getJumlah(Request $request){
        $semua=$request->tahun;

        if($semua=="Semua"){
            $januari=DB::table('resort_satwa')->whereMonth('tanggal','1')->count();
        $februari=DB::table('resort_satwa')->whereMonth('tanggal','2')->count();
        $maret=DB::table('resort_satwa')->whereMonth('tanggal','3')->count();
        $april=DB::table('resort_satwa')->whereMonth('tanggal','4')->count();
        $mei=DB::table('resort_satwa')->whereMonth('tanggal','5')->count();
        $juni=DB::table('resort_satwa')->whereMonth('tanggal','6')->count();
        $juli=DB::table('resort_satwa')->whereMonth('tanggal','7')->count();
        $agustus=DB::table('resort_satwa')->whereMonth('tanggal','8')->count();
        $september=DB::table('resort_satwa')->whereMonth('tanggal','9')->count();
        $oktober=DB::table('resort_satwa')->whereMonth('tanggal','10')->count();
        $november=DB::table('resort_satwa')->whereMonth('tanggal','11')->count();
        $desember=DB::table('resort_satwa')->whereMonth('tanggal','12')->count();

        }
        else{
            $januari=DB::table('resort_satwa')->whereMonth('tanggal','1')->whereYear('tanggal',$request->tahun)->count();
            $februari=DB::table('resort_satwa')->whereMonth('tanggal','2')->whereYear('tanggal',$request->tahun)->count();
            $maret=DB::table('resort_satwa')->whereMonth('tanggal','3')->whereYear('tanggal',$request->tahun)->count();
            $april=DB::table('resort_satwa')->whereMonth('tanggal','4')->whereYear('tanggal',$request->tahun)->count();
            $mei=DB::table('resort_satwa')->whereMonth('tanggal','5')->whereYear('tanggal',$request->tahun)->count();
            $juni=DB::table('resort_satwa')->whereMonth('tanggal','6')->whereYear('tanggal',$request->tahun)->count();
            $juli=DB::table('resort_satwa')->whereMonth('tanggal','7')->whereYear('tanggal',$request->tahun)->count();
            $agustus=DB::table('resort_satwa')->whereMonth('tanggal','8')->whereYear('tanggal',$request->tahun)->count();
            $september=DB::table('resort_satwa')->whereMonth('tanggal','9')->whereYear('tanggal',$request->tahun)->count();
            $oktober=DB::table('resort_satwa')->whereMonth('tanggal','10')->whereYear('tanggal',$request->tahun)->count();
            $november=DB::table('resort_satwa')->whereMonth('tanggal','11')->whereYear('tanggal',$request->tahun)->count();
            $desember=DB::table('resort_satwa')->whereMonth('tanggal','12')->whereYear('tanggal',$request->tahun)->count();
    }
        $data=array($januari,$februari,$maret,$april,$mei,$juni,$juli,$agustus,$september,$oktober,$november,$desember);
        return json_encode($data);
    }
}
