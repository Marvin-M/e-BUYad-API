<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class PointController extends Controller
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
        $points = DB::table('tbltransaction')
            ->leftJoin(
                'tblmempoints',
                'tbltransaction.strTransId',
                '=',
                'tblmempoints.strPointTransCode'
            )
            ->leftJoin(
                'tblbranches',
                'tbltransaction.strTransBranCode',
                '=',
                'tblbranches.strBranchCode'
            )
            ->select(
                'tbltransaction.dtmTransDate as Date',
                'tbltransaction.strTransId as Transaction',
                'tblmempoints.decPointValue as Point',
                'tblbranches.strBranchName as Branch'
            )
            ->where(
                'tblmempoints.strPointMemCode',
                '=',
                $id
            )
            ->get();

        return response()->json(array(
            'status'    => 'S',
            'message'   => 'Points successfully retrieved',
            'data'      => count($points) > 0 ? $points : null
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
