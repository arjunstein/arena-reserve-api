<?php

namespace App\Repositories\Field;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Field;

class FieldRepositoryImplement extends Eloquent implements FieldRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected Field $model;

    public function __construct(Field $model)
    {
        $this->model = $model;
    }

    public function getAllFields($perPage = null)
    {
        if ($perPage) {
            return $this->model->paginate($perPage);
        }

        return $this->model->all();
    }
}
