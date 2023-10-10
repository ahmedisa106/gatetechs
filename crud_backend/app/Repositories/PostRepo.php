<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PostRepo
{
    private Post $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * @param array|string $columns
     * @param bool $pagination
     * @param int $limit
     * @return Collection|LengthAwarePaginator|array
     */
    public function getData(array|string $columns = '*', bool $pagination = false, int $limit = 10): \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator|array
    {
        $posts = $this->model->query()->select($columns)->orderByDesc('id');
        if ($pagination) {
            return $posts->paginate($limit);
        }
        return $posts->get();

    }// end of get function

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }// end of find( function

    public function store($data)
    {
        return $this->model->create($data);
    }// end of store function

    public function update($id, $data)
    {
        try {
            $model = $this->find($id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        $model->update($data);
        return $model;
    }// end of update function

    public function delete($id)
    {

        try {
            $model = $this->find($id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return $model->delete();
    }// end of delete function
}
