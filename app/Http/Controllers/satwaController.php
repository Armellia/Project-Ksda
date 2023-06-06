<?php

namespace App\Http\Controllers;

use App\Models\satwa;
use Illuminate\Http\Request;

class satwaController extends Controller
{
    public function getJumlahsatwa(){
        $mamalia=satwa::where('jenisSatwa','Mamalia');
        $countMamalia=$mamalia->count();
        $aves=satwa::where('jenisSatwa','Aves');
        $countAves=$aves->count();
        $amfibia=satwa::where('jenisSatwa','Amfibia');
        $countAmfibia=$amfibia->count();
        $reptilia=satwa::where('jenisSatwa','Reptilia');
        $countReptilia=$reptilia ->count();
        $fish=satwa::where('jenisSatwa','Fish');
        $countFish=$fish ->count();
        $artropoda=satwa::where('jenisSatwa','Artropoda');
        $countArtropda=$artropoda->count();
        $moluska=satwa::where('jenisSatwa','Moluska');
        $countMoluska=$moluska->count();
        $json=array("Mamalia"=>$countMamalia,"Aves"=>$countAves,"Amfibia"=>$countAmfibia,
        "Reptilia"=>$countReptilia,"Fish"=>$countFish,"Artropoda"=>$countArtropda,"Moluska"=>$countMoluska);
        return json_encode($json);
    }
    public function storeSatwa(Request $request){
        Satwa::create([
            'namaLatin'=>$request->namaLatin,
        'namaSatwa'=>$request->namaSatwa,
        'jenisSatwa'=>$request->jenisSatwa,
        'ordo'=>$request->ordo,
        'keluarga'=>$request->keluarga
        ]);
        return redirect()->route('satwa');
    }
    public function getSatwa(Request $request){
        $user=Satwa::find($request->id);
        return json_encode($user);
    }
    public function editSatwa(Request $request){
        
        $satwa=satwa::find($request->id);
        $satwa->namaLatin=$request->namaLatin;
        $satwa->namaSatwa=$request->namaSatwa;
        $satwa->jenisSatwa=$request->jenisSatwa;
        $satwa->ordo=$request->ordo;
        $satwa->keluarga=$request->keluarga;
        $satwa->save();
        return redirect()->route('satwa');
    }
    public function hapusSatwa($id){
        $satwa=satwa::find($id);
        $satwa->delete();
        return redirect()->route('satwa');
    }
}
