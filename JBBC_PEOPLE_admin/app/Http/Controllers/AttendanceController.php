<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendances;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /*
    public function getAllAttendance($id=NULL)
    {
        return $id?Attendances::find($id):Attendances::all();
    }
    */

    
    public function HistoryLogAPI()
    {
        $data = Attendances::all(); 
        if(!$data){
            return response()->json([
                'code' => 2,
                'message' => 'No Data Found'
            ]);
        }else{
            return response()->json([
                'code' => 0,
                'message' => 'Data Found',
                'data' => $data
            ]);
        }
    }
    


    public function CurrentMonthLogAPI($id=NULL)
    {
        if(!$id){
            return response()->json([
                'code' => 2,
                'message' => 'No Data about the Employee'
            ]);
        }else{
             $now = Carbon::now();
             //$now_m = $now->day;
             $now_updated = $now->toDateTimeString();
             
            //  $db_month = DB::table('attendances')
            //                 ->select('date')
            //                 ->groupby('year','month')
            //
            //                ->get();
            // $months = Attendances::groupBy(function($d) {
            //     return Carbon::parse($d->date)->format('m');
            // })->get();
            $data = DB::table('attendances')
                    ->select('emp_id','date','in_time','out_time','status','overtime','created_at','updated_at')
                    ->where('emp_id','=', $id)->get();
            
            if(sizeof($data)<=0){
                 return response()->json([
                     'code' => 1,
                     'message' => 'Invalid Id'
                 ]);
             }
            
            else{
                return response()->json([
                    'code' => 0,
                    'message' => 'Data Successfully Fetched',
                    'data' => $data,
                    //'n' => $now_updated
                    //'d' => $months
                ]);
            }
        }
        //$now = Carbon::now();
        //$d = Attendances::select('date');
        //$now = Carbon::now();
        //$m = $now::parse($d->date)->month;
        //return $id?Attendances::find('date')->where('date', '=' ,$now->month):'No Information';
        //return $now->month;
        //dd($now->month);
        //return $now;
    }
}
