<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\UserPicture;

class AdminController extends Controller
{
    function getNoneApprovedImages(){
        $images = UserPicture::where('is_approved','0')->get()->toArray();
        
        return json_encode($images);

    }

    function approveImages(Request $request){
        //request have row id,user_id, isapproved = 1
        $validator = Validator::make($request->all(), [
			'id' => 'required|integer',
            'is_approved' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                "status" => false,
                "errors" => $validator->errors()
            ), 400);
        }

        $id = $request->id;

        $images = new UserPicture();
        $images::where('id', $id)
		 	 ->update([
				"is_approved" => $request -> is_approved,
              ]);
        
              return response()->json([
                'status' => true,
                'message' => 'User profile successfully updated',
            ], 200);
       


    }
}