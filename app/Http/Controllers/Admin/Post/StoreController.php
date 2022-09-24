<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Post\StoreRequest;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['preview_image'] = Storage::put('images', $data['preview_image']);
        $data['main_image'] = Storage::put('images', $data['main_image']);
        Post::firstOrCreate($data);
        return redirect()->route('admin.post.index');
    }
}
