<?php

// app/Repositories/UserRepository.php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface {
    public function all() {
        return User::all();
    }

    public function findById($id) {
        return User::findOrFail($id);
    }

    public function findByEmail($email) {
        return User::where('email', $email)->first();
    }

    public function create(array $data) {
        return User::create($data);
    }

    public function update($id, array $data) {
        $user = $this->findById($id);
        $user->update($data);
        return $user;
    }

    public function delete($id) {
        $user = $this->findById($id);
        return $user->delete();
    }
}
