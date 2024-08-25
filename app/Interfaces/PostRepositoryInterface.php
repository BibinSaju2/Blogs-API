<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function getAll();
    public function create(array $data);
    public function show($id);
    public function update(array $data);
    public function delete($id);
}
