<?php

namespace App\Repositories\Field;

use LaravelEasyRepository\Repository;

interface FieldRepository extends Repository
{
    // aplication logic methods
    public function getAllFields($perPage = null);
    public function createField(array $data);
    public function getFieldById($id);
}
