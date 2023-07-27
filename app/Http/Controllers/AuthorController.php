<?php

namespace App\Http\Controllers;

use App\Contracts\AuthorContract;
use App\Http\Requests\AuthorStoreControllerRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Exception;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $authorContract;

    public function __construct(AuthorContract $authorContract)
    {
        $this->authorContract = $authorContract;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $authors = $this->authorContract->index();

            $author = $authors->where('name', 'Amiel');

            return new AuthorResource($author, __FUNCTION__);
        } catch(Exception $e) {
            dd($e);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorStoreControllerRequest $request)
    {
        try {

            $params = $request->only([
                'name',
                'desc',
            ]);

            $author = $this->authorContract->store($params);

            return new AuthorResource($author,__FUNCTION__);
        } catch (Exception $e) {
             dd($e);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return new AuthorResource($author, __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Author $author)
    {
        try {

            $params = $request->only([
                'name',
                'desc',
            ]);

            $this->authorContract->update($author->id, $params);

            $author->refresh();

            return new AuthorResource($author,__FUNCTION__);
        } catch (Exception $e) {
             dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
    }
}
