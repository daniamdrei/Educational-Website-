<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\AdminRequest;
use App\Http\Requests\Panel\BlogRequest;
use App\Http\Resources\Panel\AdminResource;
use App\Http\Resources\Panel\BlogResource;
use App\Models\Admin;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class BlogController extends Controller
{
    public function index()
    {
        return view('panel.blogs.index');
    }

    public function datatable()
    {
        $items = Blog::query()->latest()->filter();
        $resource = new BlogResource($items);

        return filterDataTable($items, $resource, request());
    }

    public function create()
    {
        return view('panel.blogs.create');
    }

    public function store(BlogRequest $request)
    {
        $data = $request->all();
        Blog::query()->create($data)->createTranslation($request);
        return response()->json([
            'status' => true,
            'message' => __('messages.done_successfully')
        ]);
    }

    public function edit($id)
    {
        $data['item'] = Blog::query()->findOrFail($id);
        return view('panel.blogs.create', $data);
}

    public function update($id, BlogRequest $request)
    {
        $item = Blog::query()->find($id);
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
        $item = Blog::query()->find($id);

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
        $item = Blog::query()->find($id);
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

