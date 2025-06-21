<?php

namespace App\Http\Controllers\Api\Field;

use App\Http\Controllers\Controller;
use App\Http\Requests\Field\StoreFieldRequest;
use App\Http\Requests\Field\UpdateFieldRequest;
use App\Http\Resources\Field\FieldResource;
use App\Services\Field\FieldService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Arena Reserve API",
 *     version="1.0.0"
 * )
 *
 * @OA\Tag(
 *     name="Fields"
 * )
 */
class FieldController extends Controller
{
    protected $fieldRepository;

    public function __construct(FieldService $fieldService)
    {
        $this->fieldService = $fieldService;
    }

    /**
     * @OA\Get(
     *     path="/api/fields",
     *     tags={"Fields"},
     *     summary="Get list of all fields",
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Successful response"),
     *     @OA\Response(response=500, description="Server error")
     * )
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
     * @OA\Post(
     *     path="/api/fields",
     *     tags={"Fields"},
     *     summary="Create a new field",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"field_name", "price_day", "price_night", "status"},
     *             @OA\Property(property="field_name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="price_day", type="number", format="float"),
     *             @OA\Property(property="price_night", type="number", format="float"),
     *             @OA\Property(property="status", type="string", enum={"available", "unavailable"})
     *         )
     *     ),
     *     @OA\Response(response=201, description="Field created successfully"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function store(StoreFieldRequest $request)
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
     * @OA\Get(
     *     path="/api/fields/{id}",
     *     tags={"Fields"},
     *     summary="Get field by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="UUID of the field",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(response=200, description="Field found"),
     *     @OA\Response(response=404, description="Field not found")
     * )
     */
    public function show(string $id)
    {
        try {
            $field = $this->fieldService->getFieldByIdService($id);
            return response()->json([
                'status' => true,
                'message' => 'Field retrieved successfully.',
                'data' => new FieldResource($field),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while retrieving the field.',
                'data' => null,
                'error' => env('APP_DEBUG') ? $e->getMessage() : null,
            ], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/fields/{id}",
     *     tags={"Fields"},
     *     summary="Update field by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="UUID of the field",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"field_name", "price_day", "price_night", "status"},
     *             @OA\Property(property="field_name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="price_day", type="number", format="float"),
     *             @OA\Property(property="price_night", type="number", format="float"),
     *             @OA\Property(property="status", type="string", enum={"available", "unavailable"})
     *         )
     *     ),
     *     @OA\Response(response=200, description="Field updated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function update(UpdateFieldRequest $request, string $id)
    {
        try {
            $field = $this->fieldService->updateFieldService($id, $request->validated());
            return response()->json([
                'status' => true,
                'message' => 'Field updated successfully.',
                'data' => new FieldResource($field),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while updating the field.',
                'data' => null,
                'error' => env('APP_DEBUG') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/fields/{id}",
     *     tags={"Fields"},
     *     summary="Delete field by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="UUID of the field",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(response=200, description="Field deleted"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function destroy(string $id)
    {
        try {
            $this->fieldService->deleteFieldService($id);
            return response()->json([
                'status' => true,
                'message' => 'Field deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while deleting the field.',
                'data' => null,
                'error' => env('APP_DEBUG') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
