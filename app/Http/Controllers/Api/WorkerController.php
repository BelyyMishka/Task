<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkerRequest;
use App\Http\Resources\Worker\WorkerCollection;
use App\Http\Resources\Worker\WorkerResource;
use App\Models\Worker;
use App\Services\WorkerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return WorkerCollection
     */
    public function index()
    {
        $workers = $this->workerService->all();

        return new WorkerCollection($workers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WorkerRequest $request
     * @return WorkerResource
     */
    public function store(WorkerRequest $request)
    {
        $worker = $this->workerService->add($request);

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
        $worker = $worker->load('specialization');

        return new WorkerResource($worker);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WorkerRequest $request
     * @param int $id
     * @return WorkerResource
     */
    public function update(WorkerRequest $request, Worker $worker)
    {
        $worker = $this->workerService->edit($worker, $request);

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
