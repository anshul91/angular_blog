<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**Get all users details in one shot */
    public function getUsers(){
        $users = DB::select("select * from tbl_users");
        if($users)
            echo json_encode($users);
        else
            echo json_encode(['error'=>["code"=>"101","msg"=>'No data to display!!']]);
    }

    /**To get Single user details */
    public function getUserDetail($id){
        $users = DB::select("select * from tbl_users where id=".$id);
        if($users){
            echo json_encode($users);
        }else{
            echo json_encode(['error'=>['code'=>'404','msg'=>"No data found!"]]);
        }
    }

    /**Store user details in db */
    public function addUser(Request $request){
        try{
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
           $d = DB::insert("insert into tbl_users (first_name,last_name) values(?,?)",[$first_name, $last_name]);
            exit(json_encode(['success'=>['message'=>"User Added Successfully!"]]));
        }catch(\Illuminate\Database\QueryException $ex){
            exit(json_encode(['error'=>["message"=>"Error occured user cannot be added now!"]]));
        }
    }

    /**To update user details */
    public function updateUser(Request $request){
        $id = $request->route('id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        DB::table('tbl_users')
            ->where('id', $id)
            ->update(
                [
                    'first_name' => $first_name,
                    'last_name'=>$last_name
                ]
            );
        exit(json_encode(['success'=>['message'=>"Record updated successfully!"]]));
    }

    public function deleteUser(Request $request){
        $id = $request->route('id');
        DB::table('tbl_users')
        ->where('id',$id)
        ->delete();
        $this->getUsers();
        exit(json_encode(['success'=>['message'=>"Record deleted successfully!"]]));
    }
}
