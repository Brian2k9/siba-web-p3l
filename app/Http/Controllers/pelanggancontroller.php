<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pelanggan;

class pelanggancontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggans = Pelanggan::all();

        return response()->json($pelanggans, 200);
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
        $pelanggan = new pelanggan;
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->alamat_pelanggan = $request->alamat_pelanggan;
        $pelanggan->no_telp_pelanggan = $request->no_telp_pelanggan;

        $success = $pelanggan->save();

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
    public function showByNo($no_telp_pelanggan)
    {
        //return pelanggan::where('no_telp_pelanggan', $no_telp_pelanggan)->first();

        $result = Pelanggan::where('no_telp_pelanggan', 'like', "%".$no_telp_pelanggan."%")->get();

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
        $pelanggan = Pelanggan::where('id', $id)->first();

        if (is_null($pelanggan)) {
            return response()->json('Pelanggan not found', 404);
        }

        else {
            $pelanggan->nama_pelanggan = $request->nama_pelanggan;
            $pelanggan->alamat_pelanggan = $request->alamat_pelanggan;
            $pelanggan->no_telp_pelanggan = $request->no_telp_pelanggan;

            $success = $pelanggan->save();

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
        $pelanggan = Pelanggan::find($id);

        if(is_null($pelanggan)) {
            return response()->json('Pelanggan Not Found', 404);
        }
        
        else {
            $success = $pelanggan->delete();
            if($success)
                return response()->json('Success Delete', 200);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }
}
