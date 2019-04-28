<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kendaraan;

class kendaraancontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraans = Kendaraan::paginate(10);

        return response()->json($kendaraans, 200);
    }

    public function all()
    {
        $kendaraans = Kendaraan::all();

        return response()->json($kendaraans, 200);
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
        $kendaraan = new kendaraan;
        $kendaraan->merk_kendaraan = $request->merk_kendaraan;
        $kendaraan->tipe_kendaraan = $request->tipe_kendaraan;

        $success = $kendaraan->save();

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
        
        $result = Kendaraan::find($id);

        if (is_null($result)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($result, 200);
    }
    public function showByMerk($merk_kendaraan)
    {
        //return kendaraan::where('merk_kendaraan', $merk_kendaraan)->first();

        $result = Kendaraan::where('merk_kendaraan', 'like', "%".$merk_kendaraan."%")->get();

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
        $kendaraan = Kendaraan::where('id', $id)->first();

        if (is_null($kendaraan)) {
            return response()->json('Kendaraan not found', 404);
        }

        else {
            $kendaraan->merk_kendaraan = $request->merk_kendaraan;
            $kendaraan->tipe_kendaraan = $request->tipe_kendaraan;

            $success = $kendaraan->save();

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
        $kendaraan = Kendaraan::find($id);

        if(is_null($kendaraan)) {
            return response()->json('Kendaraan Not Found', 404);
        }
        
        else {
            $success = $kendaraan->delete();
            if($success)
                return response()->json('Success Delete', 200);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }

    ////////////////////////////////////////////////////////////////////////////
    public function indexMobile()
    {
        $kendaraans = Kendaraan::all();

        return response()->json($kendaraans, 200);
    }
}
