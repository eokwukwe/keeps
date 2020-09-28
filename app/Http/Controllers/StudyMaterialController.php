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
    public function getUserMaterials(Request $request)
    {
        return StudyMaterialResource::collection(
            $request->user()->studyMaterials
        );
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
        ]);

        $material = StudyMaterial::create([
            'title' => $request->title,
            'type' => $request->type,
            'link' => $request->link,
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
        $this->authorize('view', $studyMaterial);

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
        ]);

        $studyMaterial->update([
            'title' => $request->input('title', $studyMaterial->title),
            'link' => $request->input('link', $studyMaterial->link),
            'type' => $request->input('type', $studyMaterial->type),
            'user_d' => $request->user()->id,
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
