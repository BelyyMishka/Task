<?php

namespace App\Services;

use App\Models\Worker;

class WorkerService
{
    public function paginate(int $count)
    {
        return Worker::with('specialization')->paginate($count);
    }

    public function all()
    {
        return Worker::with('specialization')->get();
    }

    public function getById($id)
    {
        return Worker::with('specialization')->findOrFail($id);
    }

    public function add($request)
    {
        $worker = Worker::add($request);

        return $worker->load('specialization');
    }

    public function remove($id)
    {
        $worker = $this->getById($id);
        $worker->remove();
        return true;
    }

    public function edit($id, $request)
    {
        $worker = $this->getById($id);
        $worker = $worker->edit($request);

        return $worker->load('specialization');
    }
}
