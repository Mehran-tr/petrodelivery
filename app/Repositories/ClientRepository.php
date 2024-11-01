<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface {
    public function all() {
        return Client::all();
    }

    public function findById($id) {
        return Client::findOrFail($id);
    }

    public function findByCompanyId($companyId) {
        return Client::where('company_id', $companyId)->get();
    }

    public function create(array $data) {
        return Client::create($data);
    }

    public function update($id, array $data) {
        $client = $this->findById($id);
        $client->update($data);
        return $client;
    }

    public function delete($id) {
        $client = $this->findById($id);
        return $client->delete();
    }
}
