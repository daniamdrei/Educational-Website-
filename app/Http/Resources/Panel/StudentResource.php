<?php

namespace App\Http\Resources\Panel;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this['name'],
            'email' => $this['email'],
            'ssn_id' => $this['ssn_id'],
            'created_at' => Carbon::parse($this['created_at'])->format('Y-m-d'),
            'active' => view('panel.students.partials.active_status' , ['instance' => $this])->render(),
            'options' => view('panel.students.partials.options' , ['instance' => $this])->render()
        ];
    }
}
