<?php

namespace App\Http\Controllers;

use App\StudyMaterial;
use Illuminate\Http\Request;
use App\Http\Resources\StudyMaterialResource;
use Illuminate\Support\Facades\Auth;

class StudyMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StudyMaterialResource::collection(StudyMaterial::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required', 'string', 'unique:App\StudyMaterial,title', 'min:8'
            ],
            'link' => ['required', 'url'],
            'type' => ['required', 'string',],
            'description' => ['required', 'string', 'min:8'],
            'category_id' => ['required', 'exists:App\Category,id']
        ]);

        $material = StudyMaterial::create([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'link' => $request->link,
            'category_id' => $request->category_id,
            'user_id' => $request->user()->id
        ]);

        return new StudyMaterialResource($material);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudyMaterial  $studyMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(StudyMaterial $studyMaterial)
    {
        return new StudyMaterialResource($studyMaterial);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudyMaterial  $studyMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudyMaterial $studyMaterial)
    {
        $this->authorize('update', $studyMaterial);

        $request->validate([
            'title' => [
                'sometimes',
                'required',
                'string',
                'min:8',
                'unique:App\StudyMaterial,title',
            ],
            'link' => ['sometimes', 'required', 'url'],
            'type' => ['sometimes', 'required', 'string',],
            'description' => ['sometimes', 'required', 'string', 'min:8'],
            'category_id' => ['sometimes', 'required', 'exists:App\Category,id']
        ]);

        $studyMaterial->update([
            'title' => $request->input('title', $studyMaterial->title),
            'link' => $request->input('link', $studyMaterial->link),
            'type' => $request->input('type', $studyMaterial->type),
            'user_d' => $request->user()->id,
            'description' => $request->input(
                'description',
                $studyMaterial->description
            ),
            'category_id' => $request->input(
                'category_id',
                $studyMaterial->category_id
            ),
        ]);

        return response()->json([
            'message' => 'Update successful'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudyMaterial  $studyMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudyMaterial $studyMaterial)
    {
        $this->authorize('delete', $studyMaterial);

        $studyMaterial->delete();

        return response()->json([
            'message' => 'Study material deleted successfully'
        ], 200);
    }
}
