<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\CourseRequest;
use App\Http\Resources\Panel\CourseResource;
use App\Models\Course;
use App\Models\Courses;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
     public function index()
    {
        return view('panel.courses.index');
    }

    public function datatable()
    {
        $items = Course::query()->latest()->filter();
        $resource = new CourseResource($items);

        return filterDataTable($items, $resource, request());
    }

    public function create()
    {
        return view('panel.courses.create');
    }

    public function store(CourseRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = 'uploads/courses/' . $image->getClientOriginalName();
            $image->move('uploads/courses/', $image->getClientOriginalName());
            $data['image'] = $path;
        }
        Course::query()->create($data)->createTranslation($request);
        return response()->json([
            'status' => true,
            'message' => __('messages.done_successfully')
        ]);
    }
    public function edit($id)
    {
        $data['item'] = Course::query()->findOrFail($id);
        return view('panel.courses.create', $data);
}

    public function update($id, CourseRequest $request)
    {
        $item = Course::query()->find($id);
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
        $item = Course::query()->find($id);

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
        $item = Course::query()->find($id);
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
