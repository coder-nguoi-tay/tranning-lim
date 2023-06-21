<?php

namespace App\Repository\Package;

use App\Models\Package;

class PackageRepository implements PackageRepositoryInterface
{
    private $package;
    public function __construct(Package $package)
    {
        $this->package = $package;
    }
    public function getData()
    {
        return $this->package->get();
    }
    public function store($request)
    {
        $package = new $this->package($request);
        if (!$package->save()) {
            return false;
        }
        return true;
    }
    public function show($id)
    {
        return $this->package->find($id);
    }
    public function update($request, $id)
    {
        $package = $this->show($id)->update($request);
        if (!$package) {
            return false;
        }
        return true;
    }
    public function delete($id)
    {
        if ($this->package->destroy($id)) {
            return true;
        }
        return false;
    }
}
