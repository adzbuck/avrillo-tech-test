<?php

namespace App\Services;

use App\Models\User;
use App\Repository\UserRepositoryInterface;

class UserService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function fetchById(int $userId): ?User
    {
        return $this->userRepository->fetchById($userId);
    }
}
