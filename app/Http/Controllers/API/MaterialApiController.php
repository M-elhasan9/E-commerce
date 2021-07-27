<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = DB::table('materials')
            ->where('is_available','=',true)
            ->where('is_visible','=',true)
            ->offset(0)->limit(10)->get();

        return $materials;
    }

    public function getCategory($categoryId){
        $materials = DB::table('material_category')
            ->where('category_id','=',$categoryId)
            ->offset(0)->limit(10)->get('material_id');

        return $materials;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        $data = DB::table('materials')->where('id','=',$material['id'])->get();

        return $data;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }



}
