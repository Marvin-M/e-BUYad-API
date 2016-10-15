<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(array(
            'message'   => 'Hello World!'
        ));
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
        $member = DB::table('tblmemaccount')
            ->join('tblmember', 'tblmemaccount.strMemAcctCode', '=', 'tblmember.strMemCode')
            ->select(
             'tblmemaccount.strMemAcctCode',
             DB::raw('CONCAT(strMemFName, " " ,strMemLName)
                AS MemName'),
             'tblmemaccount.strMemAcctPinCode',          
             'tblmember.strMemAddress',
             'tblmember.strMemEmail',
             'tblmember.imgMemPhoto'
            )
            ->where('tblmember.intStatus', '=', 1)
            ->where('tblmemaccount.strMemAcctCode', '=', $request->mem_acct_code)
            ->where('tblmemaccount.strMemAcctPinCode', '=', $request->mem_acct_pin_code)
            ->first();

        return response()->json(array(
            'status'            => 'S',
            'message'           => 'Successfully retrieved',
            'data'              => $member,
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        preg_match('/MEM\d+/', $id, $container);

        $member = DB::table('tblmemaccount')
            ->join('tblmember', 'tblmemaccount.strMemAcctCode', '=', 'tblmember.strMemCode')
            ->select(
             'tblmemaccount.strMemAcctCode',
             DB::raw('CONCAT(strMemFName, " " ,strMemLName)
                AS MemName'),
             'tblmemaccount.strMemAcctPinCode',          
             'tblmember.strMemAddress',
             'tblmember.imgMemPhoto',
             'tblmember.strMemEmail'
            )
            ->where('tblmember.intStatus', '=', 1)
            ->where('tblmemaccount.strMemAcctCode', '=', $container)
            ->first();

        return response()->json(array(
            'status'            => 'S',
            'message'           => 'Successfully retrieved',
            'data'              => $member
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
