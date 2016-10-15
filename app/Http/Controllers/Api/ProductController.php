<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('tblproducts as p')
            ->leftJoin(
                'tblprodmed as m',
                'p.strProdCode',
                '=',
                'm.strProdMedCode'
            )
            ->leftJoin(
                'tblprodnonmed as nm',
                'p.strProdCode',
                '=',
                'nm.strProdNMedCode'
            )
            ->leftJoin(
                'tblprodprice as pr',
                'p.strProdCode',
                '=',
                'pr.strProdPriceCode'
            )
            ->leftJoin(
                'tblprodmedbranded as b',
                'm.strProdMedBranCode',
                '=',
                'b.strPMBranCode'
            )
            ->leftJoin(
                'tbluom as u', 
                'm.strProdMedUOMCode', 
                '=', 
                'u.strUOMCode'
            )
            ->leftJoin(
                'tblpmpackaging as pk',
                'm.strProdMedPackCode',
                '=',
                'pk.strPMPackCode'
            )
            ->leftJoin(
                'tblnmedgeneral as gt',
                'nm.strProdNMedCode',
                '=',
                'gt.strNMGenCode'
            )
            ->leftJoin(
                'tblgensize as g',
                'gt.strNMGenSizeCode',
                '=',
                'g.strGenSizeCode'
            )
            ->leftJoin(
                'tblnmedstandard as s',
                'nm.strProdNMedCode',
                '=',
                's.strNMStanCode'
            )
            ->leftJoin(
                'tbluom as un',
                's.strNMStanUOMCode',
                '=',
                'un.strUOMCode'
            )
            ->where(
                'p.intStatus',
                '=',
                1
            )
            ->select(
                'p.strProdCode as code',
                'p.strProdType as type',
                'b.strPMBranName as brand',
                DB::raw(
                    '(SELECT group_concat(g.strPMGenName SEPARATOR " ") FROM tblmedgennames mg LEFT JOIN tblprodmedgeneric g ON mg.strMedGenGenCode = g.strPMGenCode WHERE mg.strMedGenMedCode = m.strProdMedCode GROUP BY mg.strMedGenMedCode) as generic
                    '
                ),
                DB::raw(
                    'concat(m.decProdMedSize, " ", u.strUOMName) as medSize'
                ),
                'nm.strProdNMedName as NMedName',
                DB::raw(
                    'concat_ws(" ", g.strGenSizeName, s.decNMStanSize, un.strUOMName) as NMedSize'
                ),
                DB::raw(
                    '(SELECT pr.decProdPricePerPiece FROM tblprodprice pr WHERE pr.strProdPriceCode = p.strProdCode AND pr.dtmUpdated < now() ORDER BY pr.dtmUpdated DESC LIMIT 1) as pricePerPiece'
                ),
                DB::raw(
                    '(SELECT pr.decPricePerPackage FROM tblprodprice pr WHERE pr.strProdPriceCode = p.strProdCode AND pr.dtmUpdated < now() ORDER BY pr.dtmUpdated DESC LIMIT 1) as pricePerPackage'
                )
            )
            ->distinct()
            ->orderBy(
                'p.strProdType',
                'ASC'
            )
            ->get();

        return response()->json(array(
            'status'    => 'S',
            'message'   => 'Successfully retrieved',
            'data'      => $products
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
        //
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
