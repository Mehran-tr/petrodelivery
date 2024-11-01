<?php

namespace App\Repositories;

interface OrderRepositoryInterface extends RepositoryInterface {
    public function findByClientId($clientId);
}
