<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Brand::orderBy('brand_sorting','ASC')->get())
                ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="edit" data-brand_id="'.$data->brand_id.'" class="btn btn-outline btn-primary"><i class="fa fa-edit"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->brand_id.'" data-brand_id="'.$data->brand_id.'" class="btn  btn-outline btn-danger delete"><i class="fa fa-trash"></i></button>';
                        return $button;
                })
                ->rawColumns(['action'])->make(true);
        }
        return view('BackEnd.Brand.list');
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
        if ($request->ajax()) {
            $validator = Validator::make($request->all(),[
                'brand_name'=>'required',
                'brand_slug'=>'required',
                'brand_status'=>'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages(),
                ]);
            }
            else{
                $brand = new Brand();
                if ($brand) {
                    $brand->brand_name = $request->brand_name;
                    $brand->brand_slug = $request->brand_slug;
                    $brand->brand_desc = $request->brand_desc;
                    $brand->brand_status = $request->brand_status;
                    $brand->brand_sorting = count(Brand::all())+1;
                    $brand->save();

                    return response()->json([
                        'status'=>200,
                        'message'=>'Update Brand Successfully',
                    ]);
                }
                else{
                    return response()->json([
                        'status'=>404,
                        'message'=>'Brand Not Found',
                    ]);
                }
            }
        }    }

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
            $brand = Brand::findOrFail($id);
            if ($brand) {
                return response()->json([
                    'status'=>200,
                    'brand'=>$brand,
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Brand Not Found',
                ]);
            }
        }
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
        if ($request->ajax()) {
            $validator = Validator::make($request->all(),[
                'brand_name'=>'required',
                'brand_slug'=>'required',
                'brand_status'=>'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages(),
                ]);
            }
            else{
                $brand = Brand::findOrFail($id);
                if ($brand) {
                    $brand->brand_name = $request->brand_name;
                    $brand->brand_slug = $request->brand_slug;
                    $brand->brand_desc = $request->brand_desc;
                    $brand->brand_status = $request->brand_status;
                    $brand->save();

                    return response()->json([
                        'status'=>200,
                        'message'=>'Update Brand Successfully',
                    ]);
                }
                else{
                    return response()->json([
                        'status'=>404,
                        'message'=>'Brand Not Found',
                    ]);
                }
            }
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
        $brand = Brand::findOrFail($id);
        if ($brand) {
            $brand->delete();

            return response()->json([
                'status'=>200,
                'message'=>'Delete Successfully',
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Brand Not Found',
            ]);
        }
    }
}
