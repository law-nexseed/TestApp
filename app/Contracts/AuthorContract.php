<?php
namespace App\Contracts;

interface AuthorContract {
    public function index();

    public function store($params);

    public function update($id,$params);
}
