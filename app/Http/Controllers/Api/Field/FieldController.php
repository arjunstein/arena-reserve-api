<?php

namespace App\Http\Controllers\Api\Field;

use App\Http\Controllers\Controller;
use App\Http\Requests\Field\FieldRequest;
use App\Http\Resources\Field\FieldResource;
use App\Services\Field\FieldService;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    protected $fieldRepository;

    public function __construct(FieldService $fieldService)
    {
        $this->fieldService = $fieldService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', config('api.pagination.per_page'));

            $fields = $this->fieldService->getAllFieldsService($perPage);

            if ($fields->isEmpty()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data unavailable.',
                    'data' => [],
                ], 200);
            }

            return FieldResource::collection($fields)
                ->additional([
                    'status' => true,
                    'message' => 'Data retrieved successfully.'
                ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while retrieving the data.',
                'data' => null,
                'error' => env('APP_DEBUG') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FieldRequest $request)
    {
        try {
            $field = $this->fieldService->createFieldService($request->validated());
            return response()->json([
                'status' => true,
                'message' => 'Field created successfully.',
                'data' => new FieldResource($field),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while creating the field.',
                'data' => null,
                'error' => env('APP_DEBUG') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
