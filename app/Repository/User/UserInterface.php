<?php

namespace App\Repository\User;

interface UserInterface 
{
    public function index();
    public function create();
    public function store($request);
    public function update($request, $id);
    public function delete($id);
    public function show($id);
}
