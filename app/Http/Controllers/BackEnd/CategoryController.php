<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CategoryProduct;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(CategoryProduct::orderBy('category_sorting','ASC')->get())
                ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="edit" data-category_id="'.$data->category_id.'" class="btn btn-outline btn-primary"><i class="fa fa-edit"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->category_id.'" data-category_id="'.$data->category_id.'" class="btn  btn-outline btn-danger delete"><i class="fa fa-trash"></i></button>';
                        return $button;
                })
                ->rawColumns(['action'])->make(true);
        }
        return view('BackEnd.Category.list');
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
                'category_name'=>'required',
                'slug_category_product'=>'required',
                'category_desc'=>'required',
                'category_status'=>'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages(),
                ]);
            }
            else{
                $category = new CategoryProduct();
                if ($category) {
                    $category->category_name = $request->category_name;
                    $category->slug_category_product = $request->slug_category_product;
                    $category->category_desc = $request->category_desc;
                    $category->category_status = $request->category_status;
                    $category->category_sorting = count(CategoryProduct::all())+1;
                    $category->save();

                    return response()->json([
                        'status'=>200,
                        'message'=>'Update Category Successfully',
                    ]);
                }
                else{
                    return response()->json([
                        'status'=>404,
                        'message'=>'Category Not Found',
                    ]);
                }
            }
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
            $category = CategoryProduct::findOrFail($id);
            if ($category) {
                return response()->json([
                    'status'=>200,
                    'category'=>$category,
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Category Not Found',
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
                'category_name'=>'required',
                'slug_category_product'=>'required',
                'category_desc'=>'required',
                'category_status'=>'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages(),
                ]);
            }
            else{
                $category = CategoryProduct::findOrFail($id);
                if ($category) {
                    $category->category_name = $request->category_name;
                    $category->slug_category_product = $request->slug_category_product;
                    $category->category_desc = $request->category_desc;
                    $category->category_status = $request->category_status;
                    $category->save();

                    return response()->json([
                        'status'=>200,
                        'message'=>'Update Category Successfully',
                    ]);
                }
                else{
                    return response()->json([
                        'status'=>404,
                        'message'=>'Category Not Found',
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
        $category = CategoryProduct::findOrFail($id);
        if ($category) {
            $category->delete();

            return response()->json([
                'status'=>200,
                'message'=>'Delete Successfully',
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Category Not Found',
            ]);
        }
    }
}
