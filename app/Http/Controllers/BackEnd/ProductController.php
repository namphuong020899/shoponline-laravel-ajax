<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use App\Products;
use App\Gallery;
use App\CategoryProduct;
use App\Brand;
use Carbon\Carbon;
use Session;
use File;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Products::orderBy('product_id','desc')->get())
                ->addColumn('action', function($data){
                    $button = '<a href="'.route('product.edit',$data->product_id ).'"  class="btn btn-xs btn-outline btn-primary"><i class="fa fa-edit"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" class="btn btn-xs btn-outline btn-danger delete" data-id_product="'.$data->product_id.'"><i class="fa fa-trash"></i>                              
                            </button>';
                    return $button;
                })
                ->addColumn('gallery_td', function($data){
                    $gallery = Gallery::where('gallery_product_id',$data->product_id)->get()->count();
                    if ($gallery > 5) {
                        $gall = '<a href="'.route('product-gallery.show',[$data->product_id]).'" class="label label-primary">Add Gallery ('.$gallery.')</a>';
                    }else if ($gallery >= 1 && $gallery <= 3) {
                        $gall = '<a href="'.route('product-gallery.show',[$data->product_id]).'" class="label label-danger">Add Gallery ('.$gallery.')</a>';
                    }else{
                        $gall = '<a href="'.route('product-gallery.show',[$data->product_id]).'" class="label label-warning">Add Gallery ('.$gallery.')</a>';
                    }
                    return $gall;
                })
                ->addColumn('key', function($data){
                    for ($i=0; $i <= $data->product_id; $i++) { 
                        $sum = '<span>'.$i.'</span>';
                    }
                    return $sum;
                })
                ->addColumn('price_td', function($data){
                    if ($data->promotion_price > 0) {
                        $price = '<span class="text-info">'.number_format($data->promotion_price).'</span>';
                    }else{
                        $price = '<span>'.number_format($data->product_price).'</span>';
                    }
                    return $price;
                })
                ->rawColumns(['action','gallery_td','key','price_td'])
                ->make(true);
        }

        return view('BackEnd.Product.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = CategoryProduct::where('category_status',1)->orderBy('category_id','desc')->get();
        $brands    = Brand::where('brand_status',1)->orderBy('brand_id','desc')->get();
        
        return view('BackEnd.Product.add',compact('categorys','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request)
    {
        if($request->promotion_price_hidden < $request->product_price_hidden){
            $products = new Products();
            $gallery = new Gallery();

            $gallery->gallery_name = $request->product_name;
            $products->product_name = $request->product_name;
            $products->product_slug = $request->product_slug;
            $products->product_quantity = $request->product_quantity;
            $products->product_sold = 0;
            $products->category_id = $request->category_id;
            $products->brand_id = $request->brand_id;
            $products->product_desc = $request->product_desc;
            $products->product_content = $request->product_content;
            $products->product_price = $request->product_price_hidden;
            if ($request->promotion_price == '') {
                $products->promotion_price = 0;
            }else{
                $products->promotion_price = $request->promotion_price_hidden;
            }
            $products->product_status = $request->product_status;
            $products->product_view = 0;
            $products->product_date_sale = $request->product_date_sale;
            $products->product_hour_sale = $request->product_hour_sale;

            if ($request['product_image']) {
                $image = $request['product_image'];
                $text = $image->getClientOriginalExtension();
                $name = time().'_'.$image->getClientOriginalName();
                Storage::disk('public')->put($name,File::get($image));
                $image->move(public_path('uploads/gallery'),$name);
                $products->product_image = $name;
                $gallery->gallery_image = $name;
            }else{
                $products->product_image = 'default.jpg';
                $gallery->gallery_image = 'default.jpg';
            }
            $products->save();

            $gallery->gallery_product_id = $products->product_id;
            $gallery->save();
            

            return redirect()->back()->with('message','Add new Successfully');
        }else{
            return redirect()->back()->withInput()->with('message_err','Promotion Price To Big!');
        }
        if($errors->any()){
            return redirect()->back()->withInput();
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
        if (request()->ajax()) {
            $product = Products::findOrFail($id);
            if ($product) {
                return response()->json([
                    'status'=>200,
                    'product'=>$product,
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Category Not Found',
                ]);
            }
        }
        $products = Products::findOrFail($id);
        Session::put('id_edit_product',$products->product_id);

        $categorys = CategoryProduct::where('category_status',1)->orderBy('category_id','desc')->get();
        $brands    = Brand::where('brand_status',1)->orderBy('brand_id','desc')->get();
        if (Session::get('id_edit_product')) {
            $name_product = Products::where('product_id',Session::get('id_edit_product'))->first();
            return view('BackEnd.Product.edit', compact('categorys','brands','products','name_product'));
        }
        return view('BackEnd.Product.edit', compact('categorys','brands','products'));
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
        if($request->promotion_price_hidden < $request->product_price_hidden){
            $products = Products::findOrFail($id);
            // $gallery = Gallery::where('gallery_product_id',$products->product_id)->where('gallery_image',$products->product_image)->first();

            // $gallery->gallery_name = $request->product_name;
            $products->product_name = $request->product_name;
            $products->product_slug = $request->product_slug;
            $products->product_quantity = $request->product_quantity;

            $products->category_id = $request->category_id;
            $products->brand_id = $request->brand_id;
            $products->product_desc = $request->product_desc;
            $products->product_content = $request->product_content;
            $products->product_price = $request->product_price_hidden;
            if ($request->promotion_price == '') {
                $products->promotion_price = 0;
            }else{
                $products->promotion_price = $request->promotion_price_hidden;
            }
            $products->product_status = $request->product_status;
            $products->product_view = 0;
            $products->product_date_sale = $request->product_date_sale;
            $products->product_hour_sale = $request->product_hour_sale;

            if ($request['product_image']) {
                if ($products->product_image == 'default.jpg') {

                    $image = $request['product_image'];
                    $text = $image->getClientOriginalExtension();
                    $name = time().'_'.$image->getClientOriginalName();
                    Storage::disk('public')->put($name,File::get($image));
                    // $image->move(public_path('uploads/gallery'),$name);
                    $products->product_image = $name;
                    
                    // $gallery->gallery_image = $name;
                    // $gallery->gallery_name = $name;
                }else{

                    unlink(public_path('uploads/product/').$products->product_image);
                    // unlink(public_path('uploads/gallery/').$gallery->gallery_image);
                    $image = $request['product_image'];
                    $name = time().'_'.$image->getClientOriginalName();
                    Storage::disk('public')->put($name,File::get($image));
                    // $image->move(public_path('uploads/gallery'),$name);

                    $products->product_image = $name;
                    // $gallery->gallery_image = $name;
                    // $gallery->gallery_name = $name;
                }

            }
            $products->save();

            // $gallery->gallery_product_id = $products->product_id;
            // $gallery->save();
            

            return redirect()->back()->with('message','Update Successfully');
        }else{
            return redirect()->back()->withInput()->with('message_err','Promotion Price To Big!');
        }
        if($errors->any()){
            return redirect()->back()->withInput();
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $gallery = Gallery::where('gallery_product_id',$id)->get();
        if ($product) {
            if ($product->product_image == 'default.jpg') {
                foreach ($gallery as $key => $value) {
                    $del_img = $value->gallery_image;
                    if ($del_img != 'default.jpg') {
                        unlink(public_path('uploads/gallery/').$del_img);
                    }
                    
                }
                $product->delete();
            }else{
                unlink(public_path('uploads/product/').$product->product_image);
                foreach ($gallery as $key => $value) {
                    $del_img = $value->gallery_image;
                    unlink(public_path('uploads/gallery/').$del_img);
                }
                $product->delete();
            }
            return response()->json([
                'status'=>200,
                'message'=>'Delete Successfully',
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Product Not Found',
            ]);
        }
    }
}
