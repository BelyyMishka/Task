<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkerRequest;
use App\Http\Resources\Worker\WorkerResource;
use App\Models\Worker;
use App\Services\WorkerService;
use Illuminate\Http\JsonResponse;

class WorkerController extends Controller
{
    private WorkerService $workerService;

    public function __construct(WorkerService $workerService)
    {
        $this->workerService = $workerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $workers = $this->workerService->all();

        return WorkerResource::collection($workers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WorkerRequest $request
     * @return WorkerResource
     */
    public function store(WorkerRequest $request)
    {
        $data = $request->all();
        $worker = $this->workerService->add($data);

        return new WorkerResource($worker);
    }

    /**
     * Display the specified resource.
     *
     * @param Worker $worker
     * @return WorkerResource
     */
    public function show(Worker $worker)
    {
        return new WorkerResource($worker);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WorkerRequest $request
     * @param Worker $worker
     * @return WorkerResource
     */
    public function update(WorkerRequest $request, Worker $worker)
    {
        $data = $request->all();
        $worker = $this->workerService->edit($worker, $data);

        return new WorkerResource($worker);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Worker $worker
     * @return JsonResponse
     */
    public function destroy(Worker $worker)
    {
        $this->workerService->remove($worker);

        return response()->json([], 204);
    }
}
