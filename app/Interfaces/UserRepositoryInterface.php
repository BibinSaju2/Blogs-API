<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAll();
    public function create(array $data);
    public function show(array $id);
}
