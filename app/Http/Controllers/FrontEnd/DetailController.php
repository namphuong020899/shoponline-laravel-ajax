<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use App\CategoryProduct;
use App\Gallery;
use App\Review;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = Products::where('product_slug', $id)->orWhere('product_id', $id)->first();
        $porduct_dub = Products::where('product_status',1)->where('category_id',$detail->category_id)->get();
        $gallery = Gallery::where('gallery_product_id',$detail->product_id)->get();

        //update view
        $detail->product_view = $detail->product_view + 1;
        $detail->save();

        $rating = Review::where('review_id_product',$detail->product_id)->get();
        $rating_avg = Review::where('review_id_product',$detail->product_id)->avg('rating');

        return view('FrontEnd.DetailProduct.detail')->with(compact('detail','gallery','porduct_dub','rating','rating_avg'));
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
