<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;


class ActivitiesController extends Controller
{
    public function index()
    {
        return view('activities.index');
    }

    public function calendar(Request $request)
    {
        $activities = Activity::whereDate('start', '>=', $request->start)
            ->WhereDate('end', '<=', $request->end)
            ->get(['id', 'title', 'start', 'end', 'description','customer_id']);

        return response()->json($activities);
    }

    public function action(Request $request)
    {
        if ($request->type == 'add') {
            $activity = Activity::create([
                'employee_id'=>Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'start' => $request->start,
                'end' => $request->end,
                'customer_id'=>$request->customer_id,

            ]);
            return response()->json($activity);
        }
        if($request->type=='update'){
            $activity = Activity::find($request->id)->update([
                'employee_id'=>Auth::user()->id,
                'title' => $request->title,
                'customer_id' =>$request->customer_id ,
                'description' => $request->description,
                'start' => $request->start,
                'end' => $request->end,

            ]);
            return response()->json($activity);
        }
        if($request->type =='delete'){
            $activity = Activity::find($request->id)->delete();
            return response()->json($activity);
        }
    }
}
