<?php

namespace App\Http\Resources\Panel;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'name' => $this['name'],
            'email' => $this['email'],
            'created_at' => Carbon::parse($this['created_at'])->format('Y-m-d'),
            'active' => view('panel.admins.partials.active_status' , ['instance' => $this])->render(),
            'options' => view('panel.admins.partials.options' , ['instance' => $this])->render()
        ];
    }
}
