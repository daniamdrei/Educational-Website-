<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\LectureRequest;
use App\Http\Resources\Panel\LectureResource;
use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Http\Request;

class LectureController extends Controller
{
     public function index(string $id)
    {
        $data['course']= Course::query()->findOrFail($id);
         return view('panel.lectures.index' , $data);

    }

    public function datatable(string $id)
    {
        $items = Lecture::query()->where('course_id' , $id)->latest()->filter();
        $resource = new LectureResource($items);

        return filterDataTable($items, $resource, request());
    }

    public function create(string $id)
    {
        $data['course'] = Course::query()->findOrFail($id);
        return view('panel.lectures.create' , $data);
    }

    public function store(LectureRequest $request , string $id)
    {

        $course = Course::query()->findOrFail($id);
        if(!$course){
            return response()->json([
                'status' => false,
                'message' => __('messages.not_found')
            ], 404);
        }

        $data = $request->all();
        $data['course_id']= $id;
        Lecture::query()->create($data)->createTranslation($request);
        return response()->json([
            'status' => true,
            'message' => __('messages.done_successfully')
        ]);
    }

    public function edit($id)
    {
        $data['item'] = Lecture::query()->findOrFail($id);
        return view('panel.lectures.create', $data);
}

    public function update($id, LectureRequest $request)
    {
        $item = Lecture::query()->find($id);
        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => __('messages.not_found')
            ], 404);
        }
        $data = $request->all();

        $item->update($data);
        $item->createTranslation($request);

        return response()->json([
            'status' => true,
            'message' => __('messages.done_successfully')
        ]);


    }

    public function destroy($id)
    {
        $item = Lecture::query()->find($id);

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
        $item = Lecture::query()->find($id);
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
