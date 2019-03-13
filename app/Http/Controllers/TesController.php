<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
