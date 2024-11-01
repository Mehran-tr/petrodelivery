<?php

namespace App\Repositories;

interface CompanyRepositoryInterface extends RepositoryInterface {
    public function findByDomain($domain);
}
