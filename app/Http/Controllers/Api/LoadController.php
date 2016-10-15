<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class LoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $load = DB::table('tblmemcreditchange')
            ->leftJoin(
                'tblbranches', 
                'tblmemcreditchange.strMCCBranCode', 
                '=', 
                'tblbranches.strBranchCode'
            )
            ->select(
                'tblmemcreditchange.dtmMCCChanged as Date',
                'tblmemcreditchange.decMCCValue as Amount',
                'tblmemcreditchange.strMCCTransCode as Transaction',
                'tblbranches.strBranchName as Branch',
                'tblmemcreditchange.intMCCType as Type'
            )
            ->where(
                'tblmemcreditchange.strMCCMemCode', 
                '=', 
                $id
            )
            ->orderBy(
                'tblmemcreditchange.dtmMCCChanged', 
                'desc'
            )
            ->first();

        return response()->json(array(
            'status'    => 'S',
            'message'   => 'Load successfully retrieved',
            'data'      => count($load) > 0 ? $load : null
        ));
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
}
