<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use App\Services\UserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public function test_fetch_by_id_returns_null()
    {
        $userRepo = $this->getMockBuilder(UserRepositoryInterface::class)
            ->getMock();

        $userService = new UserService($userRepo);

        $userRepo
            ->expects($this->once())
            ->method('fetchById')
            ->with(5)
            ->willReturn(null);

        $actualResult = $userService->fetchById(5);

        $this->assertNull($actualResult);
    }

    public function test_fetch_by_id_returns_model()
    {
        /** @var User $givenUser */
        $givenUser = User::factory()
            ->count(1)
            ->makeOne(['id' => 4]);

        $userRepo = $this->getMockBuilder(UserRepositoryInterface::class)
            ->getMock();

        $userService = new UserService($userRepo);

        $userRepo
            ->expects($this->once())
            ->method('fetchById')
            ->with(4)
            ->willReturn($givenUser);

        $actualResult = $userService->fetchById(4);

        $this->assertInstanceOf(User::class, $actualResult);
        $this->assertEquals(4, $actualResult->id);
        $this->assertSame($givenUser, $actualResult);
    }
}
