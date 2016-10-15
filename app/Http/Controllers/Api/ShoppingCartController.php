<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use DB;

class ShoppingCartController extends Controller
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
        $existingCart = DB::table('tblcart')
            ->join(
                'tblcartdetails',
                'tblcartdetails.strCDCartId',
                '=',
                'tblcart.strCartId'
            )
            ->select(
                'tblcartdetails.intCDId',
                'tblcartdetails.intQuantity'
            )
            ->where(
                'tblcart.strMemId',
                '=',
                $request->username
            )
            ->where(
                'tblcartdetails.strCDProdCode',
                '=',
                $request->product_code
            )
            ->first();

        // Get last id
        $cart = DB::table('tblcart')
        ->select('strCartId')
        ->orderBy(
            'dtmDateTime',
            'desc'
        )
        ->first();

        if(count($cart) > 0) {
            preg_match('/CRT(\d+)/', $cart->strCartId, $container);

            $recentCartId = sprintf("CRT%05d", ((int) $container[1]) + 1);
        } else {
            $recentCartId = 'CRT00001';      
        }

        try {
            DB::beginTransaction();
            if(count($existingCart) > 0) {
                DB::table('tblcartdetails')
                    ->where(
                        'intCDId',
                        $existingCart->intCDId
                    )
                    ->update(array(
                        'intQuantity'   => 1 + $existingCart->intQuantity
                    ));
            } else {
                DB::table('tblcart')
                ->insertGetId(array(
                    'strCartId'     => $recentCartId,
                    'strMemId'      => $request->username,
                    'dtmDateTime'   => Carbon::now()
                ));

                DB::table('tblcartdetails')
                    ->insert(array(
                        'strCDCartId'   => $recentCartId,
                        'strCDProdCode' => $request->product_code,
                        'intQuantity'   => 1
                    ));
            }
            DB::commit(); 
        } catch(Exception $ex) {
            DB::rollBack();
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
        $shoppingCartLists = DB::table('tblcart')
            ->join(
                'tblcartdetails',
                'tblcartdetails.strCDCartId',
                '=',
                'tblcart.strCartId'
            )
            ->select(
                'tblcart.strCartId',
                'tblcart.dtmDateTime',
                'tblcartdetails.strCDProdCode',
                'tblcartdetails.intQuantity'
            )
            ->where(
                'tblcart.strMemId',
                '=',
                $id
            )
            ->orderBy(
                'tblcart.dtmDateTime'
            )
            ->get();

        return response()->json(array(
            'status'    => 'S',
            'message'   => 'Successfully retrieved',
            'data'      => $shoppingCartLists
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
