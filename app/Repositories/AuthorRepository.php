<?php
namespace App\Repositories;

use App\Contracts\AuthorContract;
use App\Models\Author;
use Carbon\Carbon;

class AuthorRepository implements AuthorContract {

    protected $model;

    public function __construct(Author $model)
    {
        $this->model = $model;
    }


    public function index()
    {
        $date = Carbon::now();

        return $this->model
            ->with([
                'books' => function ($query) {
                    $query->with('author');
                },
            ])
            ->get();
    }

    public function store($params)
    {
        return $this->model->create($params);
    }

    public function update($id, $params)
    {
        return $this->model->where('id', $id)->update($params);
    }
}
