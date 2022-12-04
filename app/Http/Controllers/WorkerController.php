<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkerRequest;
use App\Models\Worker;
use App\Services\SpecializationService;
use App\Services\WorkerService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class WorkerController extends Controller
{
    private WorkerService $workerService;
    private SpecializationService $specializationService;

    public function __construct(WorkerService $workerService, SpecializationService $specializationService)
    {
        $this->workerService = $workerService;
        $this->specializationService = $specializationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $title = 'Workers';
        $workers = $this->workerService->paginate(config('app.pagination_count'));

        return view('worker.index', compact('title', 'workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $title = 'Create worker';
        $specializations = $this->specializationService->all();

        return view('worker.create', compact('title', 'specializations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WorkerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WorkerRequest $request)
    {
        $this->workerService->add($request);

        return redirect()->route('workers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Worker $worker
     * @return Application|Factory|View
     */
    public function show(Worker $worker)
    {
        $title = 'Worker';

        return view('worker.show', compact('title', 'worker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Worker $worker)
    {
        $title = 'Edit worker';
        $specializations = $this->specializationService->all();

        return view('worker.edit', compact('title', 'worker', 'specializations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WorkerRequest $request
     * @param Worker $worker
     * @return RedirectResponse
     */
    public function update(WorkerRequest $request, Worker $worker)
    {
        $worker = $this->workerService->edit($worker, $request);

        return redirect()->route('workers.show', $worker);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Worker $worker
     * @return RedirectResponse
     */
    public function destroy(Worker $worker)
    {
        $this->workerService->remove($worker);

        return redirect()->route('workers.index');
    }
}
