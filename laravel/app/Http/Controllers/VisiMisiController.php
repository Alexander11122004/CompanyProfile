<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\VisiMisi;

// Pre-existing
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class VisiMisiController extends Controller
{
    public function view() {
        $visiMisi = VisiMisi::all()->where('akun_id','=', Auth::user()->id);
        return view('admin/visiMisi',['visiMisi'=>$visiMisi]);
    }

    public function store(Request $request) {

        if(VisiMisi::where('akun_id',Auth::user()->id)->exists()) {
            return redirect::back()->witherrors('Anda sudah mengisi Visi dan Misi tersebut!');
        }

        // return $request->all();
        $validatedData = Validator::make($request->all(),[
            'visi' => 'required',
            'misi' => 'required',
            'misi2' => 'required',
        ]);

        if($validatedData->fails()) {
            $messages = $validatedData->messages();
            return redirect::back()->witherrors($messages);
        }

        $visiMisi = new VisiMisi;
        $visiMisi->akun_id = Auth::user()->id;
        $visiMisi->visi = $request->visi;
        $visiMisi->misi = $request->misi;
        $visiMisi->misi2 = $request->misi2;
        $visiMisi->save();

        return redirect()->route('visiMisi')->with('success','Visi misi anda berhasil ditambahkan!');
    }

    public function edit(Request $request, $id) {
        $visiMisi = VisiMisi::find($id);
        return $visiMisi;
    }

    public function update(Request $request) {
        // dd($request->all());
        $validatedData = Validator::make($request->all(),[
            'visiEdit' => 'required',
            'misiEdit' => 'required',
            'misi2Edit' => 'required',
        ]);

        if($validatedData->fails()) {
            $messages = $validatedData->messages();
            return redirect::back()->witherrors($messages);
        }

        $visiMisi = new VisiMisi;
        $visi = $request->visiEdit;
        $misi = $request->misiEdit;
        $misi2 = $request->misi2Edit;
        $visiMisi = VisiMisi::where('akun_id',Auth::user()->id)->update(['visi'=>$visi,'misi'=>$misi,'misi2'=>$misi2]);

        return redirect::back()->with('success','Data anda berhasil diubah!');  
    }

    public function destroy($id) {
        VisiMisi::where('id',$id)->delete();
        return redirect::back()->with('success','Data berhasil dihapus!');
    }
}
