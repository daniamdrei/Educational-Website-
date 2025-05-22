
<?php

use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


function locales(){
return LaravelLocalization::getSupportedLocales();

}
function filterDataTable($items, $resource, Request $request, $relations = [])
{
    $pagination = $request->pagination;
    $items = $items->with($relations);

    //if there is no pages determine , set default = 10
    if ($pagination['perpage'] == -1 || $pagination['perpage'] == null) {
        $pagination['perpage'] = 10;
    }
    //count number of items
    $itemsCount = $items->count();
    
    $items = $items->take($pagination['perpage'])->skip($pagination['perpage'] * ($pagination['page'] - 1))->get();
    $pagination['total'] = $itemsCount;
    $pagination['pages'] = ceil($itemsCount / $pagination['perpage']);
    $data['meta'] = $pagination;
    $data['data'] = $resource->collection($items);
    return $data;
}
