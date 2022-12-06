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

    public function add(array $data)
    {
        $worker = Worker::add($data);

        return $worker;
    }

    public function remove($worker)
    {
        $worker->remove();
        return true;
    }

    public function edit($worker, array $data)
    {
        $worker = $worker->edit($data);

        return $worker;
    }
}
