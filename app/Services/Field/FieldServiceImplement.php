<?php

namespace App\Services\Field;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Field\FieldRepository;

class FieldServiceImplement extends ServiceApi implements FieldService
{

    /**
     * set title message api for CRUD
     * @param string $title
     */
    protected string $title = "";
    /**
     * uncomment this to override the default message
     * protected string $create_message = "";
     * protected string $update_message = "";
     * protected string $delete_message = "";
     */

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected FieldRepository $mainRepository;

    public function __construct(FieldRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function getAllFieldsService($perPage = null)
    {
        $perPage = $perPage ?? config('api.pagination.per_page');

        return $this->mainRepository->getAllFields($perPage);
    }

    public function createFieldService(array $data)
    {
        return $this->mainRepository->createField($data);
    }

    public function getFieldByIdService(string $id)
    {
        return $this->mainRepository->getFieldById($id);
    }

    public function updateFieldService(string $id, array $data)
    {
        return $this->mainRepository->updateField($id, $data);
    }

    public function deleteFieldService(string $id)
    {
        return $this->mainRepository->deleteField($id);
    }
}
