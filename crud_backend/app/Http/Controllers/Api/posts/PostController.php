<?php

namespace App\Http\Controllers\Api\posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\PostRepo;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostRepo $postRepo;

    public function __construct(PostRepo $repo)
    {
        $this->postRepo = $repo;
    }

    public function index(Request $request)
    {
        $data = $this->postRepo->getData(pagination: (bool)$request->pagination, limit: (int)$request->limit);
        $data = PostResource::collection($data);
        if ($request->pagination) {

            $paginated_data = [
//                'posts'=>$data->items(),
                'total' => $data->total(),
                'per_page' => $request->limit,
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'first_page_url' => $data->firstItem(),
                'next_page_url' => $data->nextPageUrl(),
                'last_page_url' => $data->lastPage(),
                'prev_page_url' => $data->previousPageUrl(),
                'path' => $data->path(),
                'from' => 1,
                'to' => $data->lastPage(),
            ];
        }

        return response()->json(['status' => 200, 'message' => '', 'errors' => [], 'data' => $data, 'pagination_urls' => @$paginated_data]);

    }// end of index function


    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $post = $this->postRepo->store($data);
        $post = PostResource::make($post);
        return response()->json(['status' => 200, 'message' => 'post stored successfully', 'errors' => [], 'data' => $post]);
    }

    public function show(Request $request)
    {
        try {
            $post = $this->postRepo->find($request->id);
            $post = PostResource::make($post);
        } catch (\Exception $exception) {
            return response()->json(['status' => 400, 'message' => "Post Not Found", 'errors' => [], 'data' => []],422);


        }
        return response()->json(['status' => 200, 'message' => '', 'errors' => [], 'data' => $post]);


    }

    public function update(PostRequest $request)
    {
        $post = $this->postRepo->update($request->id, $request->validated());
        if (!is_object($post)) {
            return response()->json(['status' => 400, 'message' => $post, 'errors' => [], 'data' => []]);
        }
        $post = PostResource::make($post);
        return response()->json(['status' => 200, 'message' => 'post updated successfully', 'errors' => [], 'data' => $post]);

    }

    public function destroy(Request $request)
    {
        $message = $this->postRepo->delete($request->id);
        if ($message !== true) {
            return response()->json(['status' => 400, 'message' => $message, 'errors' => [], 'data' => []],422);
        }
        return response()->json(['status' => 200, 'message' => 'post deleted successfully', 'errors' => [], 'data' => []],200);


    }// end of delete function
}
