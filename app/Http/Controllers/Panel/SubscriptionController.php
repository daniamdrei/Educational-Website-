<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\SubscriptionRequest;
use App\Http\Resources\Panel\SubscriptionResource;
use App\Models\Course;
use App\Models\Student;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
     public function index()
    {
        $data['students'] = Student::query()->get();
        $data['courses'] = Course::query()->get();
        return view('panel.subscriptions.index' ,$data);
    }

    public function datatable()
    {
        $items = Subscription::query()
            ->with(['student', 'course'])
            ->latest()
            ->filter();
        $resource = new SubscriptionResource($items);

        return filterDataTable($items, $resource, request());
    }

    public function create()
    {
        $data['students'] = Student::query()->get() ;
        $data['courses'] = Course::query()->get();
        return view('panel.subscriptions.create' , $data);
    }

    public function store(SubscriptionRequest $request)
    {
        $data = $request->all();
        Subscription::query()->create($data);
        return response()->json([
            'status' => true,
            'message' => __('messages.done_successfully')
        ]);
    }

    public function edit($id)
    {
        $data['item'] = Subscription::query()->findOrFail($id);
        $data['students'] = Student::query()->get() ;
        $data['courses'] = Course::query()->get();
        return view('panel.subscriptions.create', $data);
}

    public function update($id, SubscriptionRequest $request)
    {
        $item = Subscription::query()->find($id);
        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => __('messages.not_found')
            ], 404);
        }
        $data = $request->all();
        $item->update($data);
        return response()->json([
            'status' => true,
            'message' => __('messages.done_successfully')
        ]);


    }

    public function destroy($id)
    {
        $item = Subscription::query()->find($id);

        if (isset($item) && $item->delete()) {
            return response()->json([
                'status' => true,
                'message' => __('messages.deleted_successfully')
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => __('messages.error')
            ], 500);
        }
    }


    public function operation($id)
    {
        $item = Subscription::query()->find($id);
        if (isset($item)) {
            $item->is_active = !$item->is_active;
            $item->save();
            return response()->json([
                'status' => true,
                'message' => __('messages.done_successfully')
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => __('messages.error')
            ], 500);
        }
    }

}
