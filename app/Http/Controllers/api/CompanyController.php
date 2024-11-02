<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\CompanyRequest;
use App\Repositories\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller {
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository) {
        $this->companyRepository = $companyRepository;
    }

    public function index(): JsonResponse {
        $companies = $this->companyRepository->all();
        return response()->json($companies);
    }

    public function store(CompanyRequest $request): JsonResponse {
        $company = $this->companyRepository->create($request->validated());
        return response()->json($company, 201);
    }

    public function show($id): JsonResponse {
        $company = $this->companyRepository->findById($id);
        return response()->json($company);
    }

    public function update(CompanyRequest $request, $id): JsonResponse {
        $company = $this->companyRepository->update($id, $request->validated());
        return response()->json($company);
    }

    public function destroy($id): JsonResponse {
        $this->companyRepository->delete($id);
        return response()->json(null, 204);
    }
}
