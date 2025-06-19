<?php

namespace App\Services\Field;

use LaravelEasyRepository\BaseService;

interface FieldService extends BaseService
{
    public function getAllFieldsService($perPage);
    public function createFieldService(array $data);
    public function getFieldByIdService(string $id);
    public function updateFieldService(string $id, array $data);
    public function deleteFieldService(string $id);
}
