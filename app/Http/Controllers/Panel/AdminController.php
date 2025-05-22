<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\AdminRequest;
use App\Http\Resources\Panel\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index(){
        return view('panel.admins.index');
    }

    public function datatable(){

        $items = Admin::query()->latest()->filter();
        $resource = new AdminResource($items);

        return filterDataTable($items, $resource, request());
    }
       public function create()
    {
        $data['roles'] = Role::query()->get();
        return view('panel.admins.create', $data);
    }

    public function store(AdminRequest $request)
    {
        $data = $request->all();

        $data['password'] = Hash::make($data['password']);
        $admin = Admin::query()->create($data);
        $admin->assignRole((int)$request->role_id);
        return response()->json([
            'status' => true,
            'message' => __('messages.done_successfully')
        ]);
    }

     public function edit($id)
    {
        $data['item'] = Admin::query()->findOrFail($id);
        $data['roles'] = Role::query()->get();
        return view('panel.admins.create', $data);

    }

    public function update($id, AdminRequest $request)
    {
        $item = Admin::query()->find($id);
        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => __('messages.not_found')
            ], 404);
        }
        $data = $request->all();
        if ($request->password) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $item->password;
        }

        $item->update($data);
        $item->assignRole((int)$request->role_id);
        return response()->json([
            'status' => true,
            'message' => __('messages.done_successfully')
        ]);

    }

    public function destroy($id)
    {
        $item = Admin::query()->find($id);

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
        $item = Admin::query()->find($id);
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
