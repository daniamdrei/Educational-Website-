<?php

namespace App\Http\Resources\Panel;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this['title'],
            'lectures_count' => @$this['lectures_count']??0,
            'created_at' => Carbon::parse($this['created_at'])->format('Y-m-d'),
            'active' => view('panel.courses.partials.active_status' , ['instance' => $this])->render(),
            'options' => view('panel.courses.partials.options' , ['instance' => $this])->render()
        ];
    }
}
