<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecializationRequest;
use App\Http\Resources\Specialization\SpecializationCollection;
use App\Http\Resources\Specialization\SpecializationResource;
use App\Models\Specialization;
use App\Services\SpecializationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpecializationController extends Controller
{
    private SpecializationService $specializationService;

    public function __construct(SpecializationService $specializationService)
    {
        $this->specializationService = $specializationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return SpecializationCollection
     */
    public function index()
    {
        $specializations = $this->specializationService->all();

        return new SpecializationCollection($specializations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SpecializationRequest $request
     * @return SpecializationResource
     */
    public function store(SpecializationRequest $request)
    {
        $specialization = $this->specializationService->add($request);

        return new SpecializationResource($specialization);
    }

    /**
     * Display the specified resource.
     *
     * @param Specialization $specialization
     * @return SpecializationResource
     */
    public function show(Specialization $specialization)
    {
        return new SpecializationResource($specialization);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SpecializationRequest $request
     * @param Specialization $specialization
     * @return SpecializationResource
     */
    public function update(SpecializationRequest $request, Specialization $specialization)
    {
        $specialization = $this->specializationService->edit($specialization, $request);

        return new SpecializationResource($specialization);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Specialization $specialization
     * @return JsonResponse
     */
    public function destroy(Specialization $specialization)
    {
        if (!$this->specializationService->remove($specialization)) {
            return response()->json([
                'error' => 'Specialization has workers',
            ], 400);
        }

        return response()->json([], 204);
    }
}
