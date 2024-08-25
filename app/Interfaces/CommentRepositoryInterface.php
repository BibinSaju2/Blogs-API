<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function getAll();
    public function create(array $data);
    public function show(array $id);
    public function update(array $data);
    public function delete(array $id);
}
