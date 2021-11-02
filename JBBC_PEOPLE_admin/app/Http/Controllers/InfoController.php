<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{

    function getInfo($emp_id=NULL){
        $header= app('request')->header('Authorization');
        if(/*$header->Authorization*/1){
               //For invalid input
            if (!preg_match('/^[\w.-]*$/', $emp_id) || $emp_id==NULL){
                return response()->json([
                    'code'=> 1,
                    'message'=> 'Invalid Input',
                ]);
            }
            else{
                //Getting database fields
                $data =  DB::table('employees')
                ->select('name', 'image', 'emp_id', 'email', 'date_of_birth', 'address', 'joining_date', 'contact_number', 'emp_status', 'emp_designation')
                ->where('emp_id','=', $emp_id)->get();

                //For data not found in database
                if(sizeof($data) <= 0){
                    return response()->json([
                        'code'=>2,
                        'message'=>'Data not found',
                    ]);

                }else{
                    //Valid output in JSON format
                    return response()-> json([
                        'code'=>0,
                        'message'=>'OK',
                        'data'=> $data,
                        'header'=> $header,
                    ],200);
                }
               
            }
        }else{
            return response()->json([
                'code'=>3,
                'message'=>'User not authenticated',
            ]);
        }
       
        
         
    }

    /*function updateInfo(Request $req,$emp_id=Null){
        if (!preg_match('/^[\w.-]*$/', $emp_id) || $emp_id==NULL){
            return response()->json([
                'code'=> 1,
                'message'=> 'Invalid Input',
            ]);
        }elif(Employee::find($emp_id)){
            $data = DB::table('employees')
            ->where("emp_id", $emp_id)
            ->update([
                "name" => $req->name,
                "image" => $req->image,
                "address" => $req->address,
                "contace_number" => $req->contact_number,
            ]);
            return response()->json([
                'code'=>0,
                'message'=>'OK',
                'data'=> $data,
            ]);
        }else{
            return response()->json([
                'code'=>2,
                'message'=>'Data not found',
            ]);
        }
    }*/
}
