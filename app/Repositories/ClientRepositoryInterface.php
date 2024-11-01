<?php

namespace App\Repositories;

interface ClientRepositoryInterface extends RepositoryInterface {
    public function findByCompanyId($companyId);
}
