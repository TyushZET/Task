<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    public function index(){
        $subscriber = Subscriber::all();
        if ($subscriber->count() > 0){
            $data = [
                'status' => 200,
                'subscriber' => $subscriber,
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                'status' => 404,
                'message' => 'No records found',
            ];
            return response($data);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'email' => 'unique:subscribers|required|email',
            'website_id' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ]);
        }else{
            $subscribed = Subscriber::create([
                'user_id'=>$request->user_id,
                'email'=>$request->email,
                'website_id'=>$request->website_id,
            ]);
        }

        if ($subscribed){
            return response()->json([
                'status' => 200,
                'message' => 'You subscribed to website successfuly',
            ]);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Something get wrong',
            ]);

        }
    }

}
