<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class TransactionHistoryController extends Controller
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
        $transactionHistories = DB::table('tblproducts')
            ->join(
                'tblprodprice',
                'tblprodprice.strProdPriceCode',
                '=',
                'tblproducts.strProdCode'
            )
            ->join(
                'tbltransdetails',
                'tbltransdetails.strTDProdCode',
                '=',
                'tblproducts.strProdCode'
            )
            ->join(
                'tbltransaction',
                'tbltransdetails.strTDTransCode',
                '=',
                'tbltransaction.strTransId'
            )
            ->select(
                'tbltransaction.strTransId',
                'tbltransaction.dtmTransDate as transactionDate',
                DB::raw('IF(tbltransdetails.intPcOrPack = 0, SUM(tbltransdetails.intQty * tblprodprice.decProdPricePerPiece), SUM(tbltransdetails.intQty * tblprodprice.decPricePerPackage)) as totalAmount')
            )
            ->where(
                'tbltransaction.strTransCustCode',
                '=',
                $id
            )
            ->groupBy(
                'tbltransdetails.strTDTransCode'
            )
            ->get();

        return response()->json(array(
            'status'    => 'S',
            'message'   => 'Successfully retrieved',
            'data'      => $transactionHistories
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
