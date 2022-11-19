<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkerRequest;
use App\Services\WorkerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WorkerController extends Controller
{
    private WorkerService $service;

    public function __construct(WorkerService $service)
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
        $workers = $this->service->all();

        return response()->json($workers, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WorkerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(WorkerRequest $request)
    {
        $worker = $this->service->add($request);

        return response()->json($worker, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $worker = $this->service->getById($id);

        return response()->json($worker, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WorkerRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(WorkerRequest $request, $id)
    {
        $worker = $this->service->edit($id, $request);

        return response()->json($worker, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $this->service->remove($id);

        return response()->json([], 204);
    }
}
