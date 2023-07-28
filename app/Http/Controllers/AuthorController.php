<?php

namespace App\Http\Controllers;

use App\Contracts\AuthorContract;
use App\Http\Requests\AuthorStoreControllerRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
            $response = [
                'code' => Response::HTTP_OK,
                'message' => 'All authors fetched successfully',
            ];

            return (new AuthorResource($authors, __FUNCTION__))->additional($response);
        } catch(Exception $e) {
            dd($e);
        }

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
            $response = [
                'code' => Response::HTTP_OK,
                'message' => 'Author created successfully',
            ];

            return (new AuthorResource($author,__FUNCTION__))->additional($response);
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

            $response = [
                'code' => Response::HTTP_OK,
                'message' => 'Author updated successfully',
            ];

            return (new AuthorResource($author,__FUNCTION__))->additional($response);
        } catch (Exception $e) {
             dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        try{
            $author->delete();

            $response = [
                'code' => Response::HTTP_OK,
                'message' => 'Author successfully deleted',
            ];

            return (new AuthorResource([], __FUNCTION__))->additional($response);
        } catch (Exception $e) {
            dd($e);
        }
    }
}
