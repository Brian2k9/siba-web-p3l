<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pegawai;

class pegawaicontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawais = Pegawai::paginate(4);

        return response()->json($pegawais, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $pegawai = new pegawai;
        $pegawai->id_role = $request->id_role;
        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->alamat_pegawai = $request->alamat_pegawai;
        $pegawai->no_telp_pegawai = $request->no_telp_pegawai;
        $pegawai->gaji_perminggu = $request->gaji_perminggu;
        $pegawai->password_pegawai = $request->password_pegawai;
        $pegawai->id_cabang = $request->id_cabang;

        $success = $pegawai->save();

        if (!$success) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        

        $result = Pegawai::find($id);

        if (is_null($result)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($result, 200);
    }
    public function showByName($nama_pegawai)
    {
        //return pegawai::where('nama_pegawai', $nama_pegawai)->first();

        $result = Pegawai::where('nama_pegawai', 'like', "%".$nama_pegawai."%")->get();

        if (is_null($result)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($result, 200);
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
        $pegawai = Pegawai::where('id', $id)->first();

        if (is_null($pegawai)) {
            return response()->json('Pegawai not found', 404);
        }

        else {
            $pegawai->id_role = $request->id_role;
            $pegawai->nama_pegawai = $request->nama_pegawai;
            $pegawai->alamat_pegawai = $request->alamat_pegawai;
            $pegawai->no_telp_pegawai = $request->no_telp_pegawai;
            $pegawai->gaji_perminggu = $request->gaji_perminggu;
            $pegawai->password_pegawai = $request->password_pegawai;
            $pegawai->id_cabang = $request->id_cabang;

            $success = $pegawai->save();

            if (!$success) {
                return response()->json('Error Updating', 500);
            } else {
                return response()->json('Success Updating', 200);
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
        $pegawai = Pegawai::find($id);

        if(is_null($pegawai)) {
            return response()->json('Pegawai Not Found', 404);
        }
        
        else {
            $success = $pegawai->delete();
            if($success)
                return response()->json('Success Delete', 200);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }
}
