<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->level == 'admin'){
            $userList = User::whereIn('level',['client'])->get();
        
            return view('admin.page.userList', compact('userList'));
        }
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

    public function tampilLogin(){
        return view('admin.login');
    }

    public function login(Request $request){
        if(Auth::attempt($request->only(['username','password']))){
            $user = Auth::user();

            if($user->level == 'admin'){
                return redirect('admin');
            }else{
                return back();
            }
        }
    }

    public function logoutAdd(){
        Auth::logout();
        return redirect('login/admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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

    public function approval($id){
        $user = Auth::user();

        if($user->level == 'admin'){
            $approval = User::where('id',$id)->first();
            if($approval->approval == '0'){

                User::where('id',$id)->update([
                    'approval' => 1
                ]);

                return back()->with('success','berhasil menyetujui');
            }else{

                User::where('id',$id)->update([
                    'approval' => '0'
                ]);

                return back()->with('alert','akun ditahan');
            }
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login/admin');
    }
    
}
