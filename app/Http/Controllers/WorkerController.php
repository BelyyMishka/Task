<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkerRequest;
use App\Services\SpecializationService;
use App\Services\WorkerService;

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
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $title = 'Worker';
        $worker = $this->workerService->getById($id);

        return view('worker.show', compact('title', 'worker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $title = 'Edit worker';
        $worker = $this->workerService->getById($id);
        $specializations = $this->specializationService->all();

        return view('worker.edit', compact('title', 'worker', 'specializations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WorkerRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WorkerRequest $request, $id)
    {
        $worker = $this->workerService->edit($id, $request);

        return redirect()->route('workers.show', $worker->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->workerService->remove($id);

        return redirect()->route('workers.index');
    }
}
