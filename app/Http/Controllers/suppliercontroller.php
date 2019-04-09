<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\supplier;

class suppliercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return response()->json($suppliers, 200);
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
        //post
        $supplier = new supplier;
        $supplier->nama_supplier = $request->nama_supplier;
        $supplier->sales_supplier = $request->sales_supplier;
        $supplier->no_telp_supplier = $request->no_telp_supplier;
        $supplier->alamat_supplier = $request->alamat_supplier;

        $success = $supplier->save();

        if (!$success) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 204);
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
        
        $result = Supplier::find($id);

        if (is_null($result)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($result, 200);
    }
    public function showByName($nama_supplier) //show by nama supplier (partial show)
    {
        $result = Supplier::where('nama_supplier', 'like', "%".$nama_supplier."%")->get();

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
        $supplier = Supplier::where('id', $id)->first();

        if (is_null($supplier)) {
            return response()->json('Supplier not found', 404);
        }

        else {
            $supplier->nama_supplier = $request->nama_supplier;
            $supplier->sales_supplier = $request->sales_supplier;
            $supplier->no_telp_supplier = $request->no_telp_supplier;
            $supplier->alamat_supplier = $request->alamat_supplier;


            $success = $supplier->save();

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
        $supplier = Supplier::find($id);

        if(is_null($supplier)) {
            return response()->json('Supplier Not Found', 404);
        }
        
        else {
            $success = $supplier->delete();
            if($success)
                return response()->json('Success Delete', 204);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }
}
