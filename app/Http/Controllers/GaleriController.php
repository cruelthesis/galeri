<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Http\Requests\StoreGaleriRequest;
use App\Http\Requests\UpdateGaleriRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        // $galeri = Galeri::where('user_id', $user)
        // ->where('status', 'accept')
        // ->latest()->get();

        $galeri = Galeri::join('users', 'users.id', '=', 'galeris.user_id')
        ->where('user_id', $user)
        ->where('users.level', 'client')
        ->where('galeris.status', 'accept')
        ->select('galeris.*','users.username','users.fotoprofil','users.created_at as users.created')
        // ->select('galeris.created_at as galeris.tanggaldibuat', 'users.created_at as users.created_at')
        // ->orderBy('galeris.created_at')
        ->latest()->get();
        
        return view('home', compact('galeri'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGaleriRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user()->id;

        if($request->foto){
            $namafile = $user."-".date('YmdHis').$request->file('foto')->getClientOriginalName();
            $request->foto->move(public_path('img'), $namafile);

            Galeri::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto' => $namafile,
                'tanggal' => now(),
                'user_id' => $user
            ]);

            return back();
        }else{

            Galeri::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                // 'foto' => $namafile,
                'tanggal' => now(),
                'user_id' => $user
            ]);
            return back();

        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Galeri::where('id', '=', $id)->delete();
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeri $galeri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGaleriRequest  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user()->id;

        $file = $request->foto;

        if(isset($file)){
            $namafile = $user."-".date('YmdHis').$request->file('foto')->getClientOriginalExtension();
            $request->foto->move(public_path('img'), $namafile);

            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto' => $namafile
            ];

            Galeri::where('id', $id)->update($data);
        }else{
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ];

            Galeri::where('id', $id)->update($data);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galeri $galeri)
    {
        //
    }
}
