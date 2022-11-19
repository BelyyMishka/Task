<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecializationRequest;
use App\Services\SpecializationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpecializationController extends Controller
{
    private SpecializationService $service;

    public function __construct(SpecializationService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $specializations = SpecializationService::all();

        return response()->json($specializations, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SpecializationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SpecializationRequest $request)
    {
        $specialization = $this->service->add($request);

        return response()->json($specialization, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $specialization = $this->service->getById($id);

        return response()->json($specialization, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SpecializationRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SpecializationRequest $request, $id)
    {
        $specialization = $this->service->edit($id, $request);

        return response()->json($specialization, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (!$this->service->remove($id)) {
            return response()->json([
                'error' => 'Specialization has workers',
            ], 400);
        }

        return response()->json([], 204);
    }
}
