<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostApproveController extends Controller
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
            $data = Galeri::join('users','users.id','=','galeris.user_id')
            ->where('galeris.status','pending')
            ->select('galeris.*', 'users.username', 'users.nama', 'users.fotoprofil')
            ->get();
            
            return view('admin.page.approval', compact('data'));
        }else{
            return redirect('login/admin');
        }
    }

    public function indexDecline(){
        $user = Auth::user();
        if($user->level == 'admin'){
            $data = Galeri::join('users','users.id','=','galeris.user_id')
            ->where('galeris.status','declined')
            ->select('galeris.*', 'users.username', 'users.nama', 'users.fotoprofil')
            ->get();
            
            return view('admin.page.decline', compact('data'));
        }else{
            return redirect('login/admin');
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
        $user = Auth::user();
        $status = $request->status;
        if($user->level =='admin'){
            if($status == 'accept'){
                Galeri::where('id',$id)->update([
                    'status' => 'accept'
                ]);

                return back();
            }

            if($status == 'decline'){
                Galeri::where('id',$id)->update([
                    'status' => 'decline'
                ]);

                return back();
            }
        }
        
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
