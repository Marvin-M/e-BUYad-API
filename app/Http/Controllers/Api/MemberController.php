<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use DB;

class MemberController extends Controller
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
        $memberDetails = DB::table('tblmember')
            ->select(
                'tblmember.strMemCode',
                DB::raw('CONCAT(tblmember.strMemFName, " ", tblmember.strMemLName) as strMemFullName'),
                'tblmember.datMemBirthday',
                DB::raw('ROUND(DATEDIFF("2016-09-11", tblmember.datMemBirthday) / 365.25) as intAge'),
                'tblmember.strMemOSCAID',
                'tblmember.strMemAddress',
                'tblmember.strMemHomeNum',
                'tblmember.strMemContNum',
                'tblmember.strMemEmail'
            )
            ->where('tblmember.strMemCode', '=', $id)
            ->first();

        return response()->json(array(
            'status'            => 'S',
            'message'           => 'Successfully retrieved',
            'data'              => $memberDetails
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
