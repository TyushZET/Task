<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriberRequest;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscriber = Subscriber::all();
        if ($subscriber->count() > 0) {
            $data = [
                'status' => 200,
                'subscriber' => $subscriber,
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No records found',
            ];
            return response($data);
        }
    }

    public function store(SubscriberRequest $request)
    {
        $subscribed = Subscriber::create($request->validated());

        if ($subscribed) {
            return response()->json([
                'status' => 200,
                'message' => 'You subscribed to website successfuly',
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something get wrong',
            ]);

        }
    }

}
