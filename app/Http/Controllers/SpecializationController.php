<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecializationRequest;
use App\Models\Specialization;
use App\Services\SpecializationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $title = 'Specializations';
        $specializations = $this->specializationService->paginate(config('app.pagination_count'));

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
        $this->specializationService->add($request);

        return redirect()->route('specializations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Specialization $specialization
     * @return Application|Factory|View
     */
    public function show(Specialization $specialization)
    {
        $title = 'Specialization';

        return view('specialization.show', compact('title', 'specialization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Specialization $specialization
     * @return Application|Factory|View
     */
    public function edit(Specialization $specialization)
    {
        $title = 'Edit specialization';

        return view('specialization.edit', compact('title', 'specialization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SpecializationRequest $request
     * @param Specialization $specialization
     * @return RedirectResponse
     */
    public function update(SpecializationRequest $request, Specialization $specialization)
    {
        $specialization = $this->specializationService->edit($specialization, $request);

        return redirect()->route('specializations.show', $specialization);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Specialization $specialization
     * @return RedirectResponse
     */
    public function destroy(Specialization $specialization)
    {
        if (!$this->specializationService->remove($specialization)) {
            return redirect()->back()->with('error', 'This specialization has workers.');
        }

        return redirect()->route('specializations.index');
    }
}
