<?php

namespace App\Repository\Package;


use App\Models\Package;
use App\Repository\BaseRepository;

class PackageRepository extends BaseRepository
{
    protected $model;
    public function __construct(Package $package)
    {
        $this->model = $package;
    }
}
