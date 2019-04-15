<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cabang;

class cabangcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabangs = Cabang::paginate(10);

        return response()->json($cabangs, 200);
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
        $request->validate([
            'no_telp_cabang' => 'required|unique:cabangs,no_telp_cabang|max:255',
            
        ]);

        $cabang = new cabang;
        $cabang->nama_cabang = $request->nama_cabang;
        $cabang->alamat_cabang = $request->alamat_cabang;
        $cabang->no_telp_cabang = $request->no_telp_cabang;
        
        $success = $cabang->save();

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
       
        $result = Cabang::find($id);

        if (is_null($result)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($result, 200);
    }
    public function showByName($nama_cabang)
    {
        //return cabang::where('nama_cabang', $nama_cabang)->first();

        $result = Cabang::where('nama_cabang', 'like', "%".$nama_cabang."%")->get();

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
        $request->validate([
            'no_telp_cabang' => 'required|unique:cabangs,no_telp_cabang,'.$id.'|max:255',
            ]);

        $cabang = Cabang::where('id', $id)->first();

        if (is_null($cabang)) {
            return response()->json('Cabang not found', 404);
        }

        else {
            $cabang->nama_cabang = $request->nama_cabang;
            $cabang->alamat_cabang = $request->alamat_cabang;
            $cabang->no_telp_cabang = $request->no_telp_cabang;
            
            $success = $cabang->save();

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
        $cabang = Cabang::find($id);

        if(is_null($cabang)) {
            return response()->json('Cabang Not Found', 404);
        }
        
        else {
            $success = $cabang->delete();
            if($success)
                return response()->json('Success Delete', 200);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }
}
