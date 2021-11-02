<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\attendance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class LogInController extends Controller
{

    public function logIn(Request $req)
    {
            // $emp_id = $request->input('emp_id');
            // $password = $request->input('password');

             $emp_id = $req->emp_id;

             $user = Employee::where('emp_id', '=', $emp_id)->first();
             if (!$user) {
                return response()->json(['success'=>false, 'message' => 'Login Fail, please check employee id']);
             }
             if (Hash::check($req->password,$user->password)) {
          
                $new_user = new attendance;
                $new_user->emp_id = $req->emp_id;
                $date_time = Carbon::now();
                $new_user->date =  $date_time->toDateString(); 
                $new_user->in_time = $date_time->toTimeString(); 
                $new_user->status = 3;
                // if($new_user->in_time >  9.30){
                //     $new_user->status = 0;
                //  }
                $res = $new_user->save();
                if(!$res){
                    return ["result"=>"emp_id and password is ok but data not successfully saved in attendance table"];
                }
                else{
                     $token = $user->createToken('web-app')->plainTextToken;
                     return response()->json(['code'=>'0','message'=>'ok', 'data' => ['token'=> $token,'emp_id' => $user->emp_id,'emp_name'=>$user->name,'image'=>$user->image]]);
                }
             }
             else{
                return response()->json(['success'=>false, 'message' => 'Login Fail, please check password']);

             }

    }

    public function signUp(Request $req)
    {
        $emp = new Employee;
        $emp->name = $req->name;
        $emp->emp_id = $req->emp_id;
        // $emp->image = $req->image;  /// this is not a right way to store an image
        $emp->password = Hash::make($req->password);
       // $emp_pass = Hash::make($req->password);
        $emp->email = $req->email;
        $emp->date_of_birth = $req->date_of_birth;
        $emp->address = $req->address;
        $emp->joining_date = $req->joining_date;
        $emp->contact_number = $req->contact_number;
        $emp->emp_status = $req->emp_status;
        $emp->emp_designation = $req->emp_designation;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time. '.' .$extension;
            $file->move('uploads/images',$filename);
            $images->image = $filename;
        }
        else{
            return $request;
            $images->image = '';
        }
        $res = $emp->save();
        if($res){
            return ["result" => "successful"];
        }
        else{
            return ["result" => "unsuccessful"];
        }

    }
}
