<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LiveSearchController extends Controller
{
   	public function index(){
   		return view('livesearch');
   	}

   	public function show_data(Request $request){
   		$customer_search = $request->customer_search;
   		
   		if ($customer_search != '') {
   			$output = '';
   			 $data = DB::table('customer')
		         ->where('customer_name', 'like', '%'.$customer_search.'%')
		         ->orWhere('address', 'like', '%'.$customer_search.'%')
		         ->orWhere('city', 'like', '%'.$customer_search.'%')
		         ->orWhere('postal_code', 'like', '%'.$customer_search.'%')
		         ->orWhere('country', 'like', '%'.$customer_search.'%')
		         ->orderBy('id', 'desc')
		         ->get();

		     $row_data = count($data);
		     if ($row_data>0) {
		     	foreach ($data as $key => $row) {
		     		$output.= '<tr>
					         <td>'.$row->customer_name.'</td>
					         <td>'.$row->address.'</td>
					         <td>'.$row->city.'</td>
					         <td>'.$row->postal_code.'</td>
					         <td>'.$row->country.'</td>
					        </tr>';
		     	}
		     }else{
		     	$output .= '<tr>
		     	        <td align="center" colspan="5">No Data Found</td>
		     	       </tr>';
		     }

		     echo $output;

   		}
   	}

}
