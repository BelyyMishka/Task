<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecializationRequest;
use App\Services\SpecializationService;
use Illuminate\Http\RedirectResponse;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $title = 'Specializations';
        $specializations = $this->service->paginate(config('app.pagination_count'));

        return view('specialization.index', compact('title', 'specializations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $title = 'Create specialization';

        return view('specialization.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SpecializationRequest $request
     * @return RedirectResponse
     */
    public function store(SpecializationRequest $request)
    {
        $this->service->add($request);

        return redirect()->route('specializations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $title = 'Specialization';
        $specialization = $this->service->getById($id);

        return view('specialization.show', compact('title', 'specialization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $title = 'Edit specialization';
        $specialization = $this->service->getById($id);

        return view('specialization.edit', compact('title', 'specialization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SpecializationRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(SpecializationRequest $request, $id)
    {
        $specialization = $this->service->edit($id, $request);

        return redirect()->route('specializations.show', $specialization->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (!$this->service->remove($id)) {
            return redirect()->back()->with('error', 'This specialization has workers.');
        }

        return redirect()->route('specializations.index');
    }
}
