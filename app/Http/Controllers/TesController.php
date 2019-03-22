<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class TesController extends Controller
{
    //

    public function create(){
        $tes="create";
        $t="cte";
        $k="";
        return view('tesview', compact('tes','t','k'));
    }

    public function edit(){
        $tes="edit";
        $t="c";
        $k="k";
        return view('tesview', compact('tes','t','k'));
    }

    public function backing(){

        return redirect()->back()->with(['success'=>'berhasil kembali<br>']);
    }

    public function nama(Product $produk){
        return $produk->title." ".$produk->price;
    }
    public function cek(){
       
        $endpoint = "https://apifootball.com/api/?action=get_H2H&firstTeam=Barcelona&secondTeam=Arsenal&APIkey=118a15ca6984aa4ffcc29d5a6843f0dcd46c5966eac32ffe5ae9e727d56646f0";
        $client = new \GuzzleHttp\Client();
     

        $request = $client->get($endpoint);
        
       
        // url will be: http://my.domain.com/test.php?key1=5&key2=ABC;

        $response = $request->getBody()->getContents();
        $data= json_decode($response);
        return response()->json($data);
       
    }
}
