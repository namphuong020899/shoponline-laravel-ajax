<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Wishlist;
use Auth;
use Session;


class WishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_wish = Wishlist::join('product','product.product_id','wishlist.id_product')
                            ->where('id_user',Auth::id())
                            ->where('wish_status',0)
                            ->get();

        return view('FrontEnd.Wishlist.list',compact('all_wish'));
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
        $check_wish = Wishlist::where('id_user',Auth::id())->where('id_product',$request->id)->first();
        if ($check_wish && $check_wish->wish_status == 0) {
            $check_wish->wish_status = 1;
            $check_wish->save();

            return response()->json([
                'action'=>'remove'
            ]);
        }elseif($check_wish && $check_wish->wish_status != 0){

            $check_wish->wish_status = 0;
            $check_wish->save();

            return response()->json([
                'action'=>'add'
            ]);
        }else{
            $wish = new Wishlist();
            $wish->id_user = Auth::id();
            $wish->id_product = $request->id;
            $wish->wish_status = 0;
            $wish->save();

            return response()->json([
                'action'=>'add'
            ]);
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
        $wish = Wishlist::find($id);
        $wish->wish_status = 1;
        $wish->save();

        return back();
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
