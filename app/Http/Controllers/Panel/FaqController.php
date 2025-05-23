<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\FaqRequest;
use App\Http\Resources\Panel\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Testing\Fakes\Fake;

class FaqController extends Controller
{
    public function index()
    {
        return view('panel.faqs.index');
    }

    public function datatable()
    {
        $items = Faq::query()->latest()->filter();
        $resource = new FaqResource($items);

        return filterDataTable($items, $resource, request());
    }

    public function create()
    {
        return view('panel.faqs.create');
    }

    public function store(FaqRequest $request)
    {
        $data = $request->all();
        Faq::query()->create($data)->createTranslation($request);
        return response()->json([
            'status' => true,
            'message' => __('messages.done_successfully')
        ]);
    }

    public function edit($id)
    {
        $data['item'] = Faq::query()->findOrFail($id);
        return view('panel.faqs.create', $data);
}

    public function update($id, FaqRequest $request)
    {
        $item = Faq::query()->find($id);
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
        $item = Faq::query()->find($id);

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
        $item = Faq::query()->find($id);
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
