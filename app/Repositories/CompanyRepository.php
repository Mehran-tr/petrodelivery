<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface {
    public function all() {
        return Company::all();
    }

    public function findById($id) {
        return Company::findOrFail($id);
    }

    public function findByDomain($domain) {
        return Company::where('domain', $domain)->first();
    }

    public function create(array $data) {
        return Company::create($data);
    }

    public function update($id, array $data) {
        $company = $this->findById($id);
        $company->update($data);
        return $company;
    }

    public function delete($id) {
        $company = $this->findById($id);
        return $company->delete();
    }
}
