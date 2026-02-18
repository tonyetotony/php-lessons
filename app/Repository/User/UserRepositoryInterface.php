<?php

namespace App\Repository\User;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

interface UserRepositoryInterface
{
    public function store(UserStoreRequest $userStoreRequest): User;
    public function update(UserUpdateRequest $userUpdateRequest, User $user): User;
    public function destroy(User $user): bool;
}