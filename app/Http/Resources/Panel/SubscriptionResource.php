<?php

namespace App\Http\Resources\Panel;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'student_name' => @$this['student']?->name,
            'course_title' => @$this['course']?->title,
            'start_date' => $this['start_date'],
            'end_date' => $this['end_date'],
            'created_at' => Carbon::parse($this['created_at'])->format('Y-m-d'),
            'active' => view('panel.subscriptions.partials.active_status', ['instance' => $this])->render(),
            'options' => view('panel.subscriptions.partials.options', ['instance' => $this])->render()
        ];
    }
}
