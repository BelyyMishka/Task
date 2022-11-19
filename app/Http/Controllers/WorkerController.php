<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkerRequest;
use App\Services\SpecializationService;
use App\Services\WorkerService;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $title = 'Workers';
        $workers = $this->service->paginate(config('app.pagination_count'));

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
        $specializations = SpecializationService::all();

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
        $this->service->add($request);

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
        $worker = $this->service->getById($id);

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
        $worker = $this->service->getById($id);
        $specializations = SpecializationService::all();

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
        $worker = $this->service->edit($id, $request);

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
        $this->service->remove($id);

        return redirect()->route('workers.index');
    }
}
