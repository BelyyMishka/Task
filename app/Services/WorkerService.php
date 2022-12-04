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
        return Worker::with('specialization')->find($id);
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

    public function edit($worker, $request)
    {
        $worker = $worker->edit($request);

        return $worker->load('specialization');
    }
}
