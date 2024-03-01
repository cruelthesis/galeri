<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }


    public function register()
    {
        return view('register');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'username' => 'required | unique:users',
            'email' => 'required | email | unique:users',
            'password' => 'required'
        ]);

        User::create([
            'nama' => $data['nama'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return redirect('/');
    }

    public function masuk(Request $request){
        if(Auth::attempt($request->only(['username','password']))){
            $user = Auth::user();

            if($user->level == 'client'){
                if($user->approval == 1){
                    return redirect('galeri');
                }else{
                    return redirect('/');
                }
            }
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if($request->foto == null && $request->password == null){
            User::where('id',$id)->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'email' => $request->email
            ]);

            return back();
        }

        if($request->foto && $request->password){

            $namafile = $id."-".date('YmdHis').$request->foto->getClientOriginalName();
            $request->foto->move(public_path('img'), $namafile);

            User::where('id',$id)->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'fotoprofil' => $namafile,
                'password' => Hash::make($request['password']),

            ]);

            return back();
        }

        if ($request->foto == null || $request->password) {

            User::where('id',$id)->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request['password']),

            ]);
            

            return back();
        }

        if($request->foto || $request->password == null){
            
            $namafile = $id."-".date('YmdHis').$request->file('foto')->getClientOriginalName();
            $request->foto->move(public_path('img'), $namafile);

            User::where('id',$id)->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'fotoprofil' => $namafile,

            ]);

            return back();
        }

        // $user = Auth::user()->id;
        // if(!isset($request->password)){

        //     // $namafile = $id."-".date('YmdHis').$request->file('foto')->getClientOriginalName();
        //     // $request->foto->move(public_path('img'), $namafile);

        //     User::where('id', $id)->update([
        //         'nama' => $request->nama,
        //         'username' => $request->username,
        //         'email' => $request->email,
        //         // 'password' => Hash::make($request['password']),
        //         // 'foto' => $namafile
        //     ]);

        //     return back();
        // }else if(isset($request->foto)){

        //     $namafile = $id."-".date('YmdHis').$request->file('foto')->getClientOriginalName();
        //     $request->foto->move(public_path('img'), $namafile);

        //     User::where('id', $id)->update([
        //         'nama' => $request->nama,
        //         'username' => $request->username,
        //         'email' => $request->email,
        //         'foto' => $namafile,
        //         // 'password' => Hash::make($request['password']),
        //     ]);

        //     return back();
        // }else{
        //     User::where('id', $id)->update([
        //         'nama' => $request->nama,
        //         'username' => $request->username,
        //         'email' => $request->email,
        //         // 'foto' => $namafile
        //         'password' => Hash::make($request['password']),
        //     ]);

        //     return back();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
