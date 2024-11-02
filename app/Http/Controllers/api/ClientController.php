<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Repositories\ClientRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller {
    protected $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository) {
        $this->clientRepository = $clientRepository;
    }

    public function index(): JsonResponse {
        $clients = $this->clientRepository->all();
        return response()->json($clients);
    }

    public function store(ClientRequest $request): JsonResponse {
        $client = $this->clientRepository->create($request->validated());
        return response()->json($client, 201);
    }

    public function show($id): JsonResponse {
        $client = Client::findOrFail($id);

        // Check if the client belongs to the same company as the authenticated user
        if (auth()->user()->company_id !== $client->company_id) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }

        return response()->json($client, 200);
    }

    public function update(ClientRequest $request, $id): JsonResponse {
        $client = $this->clientRepository->update($id, $request->validated());
        return response()->json($client);
    }

    public function destroy($id): JsonResponse {
        $this->clientRepository->delete($id);
        return response()->json(null, 204);
    }
}
