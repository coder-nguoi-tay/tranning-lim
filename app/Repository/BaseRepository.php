<?php

namespace App\Repository;


class BaseRepository
{
    protected $model;

    public function getData()
    {
        return $this->model->get();
    }
    public function store($request)
    {
        $base = new $this->model($request);
        $base->save();
        if (!$base->save()) {
            return false;
        }
        return true;
    }
    public function show($id)
    {
        return $this->model->find($id);
    }
    public function update($request, $id)
    {
        $base = $this->show($id)->fill($request);
        if ($base->save()) {
            return $base;
        }
        return false;
    }
    public function delete($id)
    {
        if ($this->model->destroy($id)) {
            return true;
        }
        return false;
    }
}
