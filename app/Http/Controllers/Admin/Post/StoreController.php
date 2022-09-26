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
        try {
            $data = $request->validated();
            $tag_ids = $data['tag_ids'];
            unset($data['tag_ids']);

            $data['preview_image'] = Storage::put('images', $data['preview_image']);
            $data['main_image'] = Storage::put('images', $data['main_image']);
            $post = Post::firstOrCreate($data);
            $post->tags()->attach($tag_ids);
        } catch(\Exception $exception) {
            abort(500);
        }
        return redirect()->route('admin.post.index');
    }
}
