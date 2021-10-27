<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;
use Validator;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if (request()->ajax()) {
            $columns = array("fee_matp", "fee_maqh", "fee_xaid", "fee_feeship");
            $limit = $request->length;
            $start = $request->start;
            
            $dir = $request->input('order.0.dir');
            if ($request->input('order.0.column')) {
                $order = $columns[$request->input('order.0.column')];
                $result = Feeship::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            }else{
                $result = Feeship::orderby('fee_id','DESC')->get();
            }
            
            $search = $request->input('search.value');
            if ($search) {
                $result = Feeship::join('tinhthanhpho', 'fee_matp', '=', 'tinhthanhpho.matp')
                ->join('quanhuyen', 'fee_maqh', '=', 'quanhuyen.maqh')
                ->join('xaphuongthitran', 'fee_xaid', '=', 'xaphuongthitran.xaid')
                ->orWhere( function($query) use ( $search ) {
                $query->where( "name_city", "LIKE", "%".$search."%" )
                ->orwhere( "name_xaphuong", "LIKE", "%".$search."%" )
                ->orwhere( "name_quanhuyen", "LIKE", "%".$search."%" )
                ->orwhere( "fee_feeship", "LIKE", "%".$search."%" );

                 } )->take( $request->length )->skip( $request->start )->get();
            }

            $i = 0;
            $data = array();
            foreach($result as $row)
            {
                $i++;
                $sub_array = array();
                $sub_array[] = $i;
                $sub_array[] = $row->city->name_city;
                $sub_array[] = $row->province->name_quanhuyen;
                $sub_array[] = $row->wards->name_xaphuong;
                $sub_array[] = number_format($row['fee_feeship'],0,',','.');
                $sub_array[] = $row->fee_id;
                $data[] = $sub_array;
            }

            return datatables()->of($data)->make(true);
        }
        $citys = City::orderby('matp','ASC')->get();
        return view('BackEnd.Delivery.list', compact('citys'));
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
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'city'=>'required',
            'province'=>'required',
            'wards'=>'required',
            'fee_ship'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            $feeship = new Feeship();
            $feeship->fee_matp = $request->city;
            $feeship->fee_maqh = $request->province;
            $feeship->fee_xaid = $request->wards;
            $feeship->fee_feeship = $request->fee_ship;
            $feeship->save();

            return response()->json([
                'status'=>200,
                'message'=>'Update Slider Successfully',
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $data = $request->all();
        // $output = '';
        if($data['action']=="city"){
            $output = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
        }else{
            $output = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
        }
        return response()->json([
            'output' => $output,
            'action' => $data['action'],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $validator = Validator::make($request->all(),[
            'fee_value'=>'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            $feeship = Feeship::findOrFail($id);
            $price = $request->fee_value;

            if ($feeship) {
                $right      = rtrim($price , "0");
                $right_1    = rtrim($right  , ".");
                $left       = ltrim($price , $right_1);
                $left_1     = ltrim($left , ".");

                $feeship->fee_feeship = $right_1.$left_1;
                $feeship->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'Update Successfully',
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Fee Ship Not Found',
                ]);
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
        //
    }
}
