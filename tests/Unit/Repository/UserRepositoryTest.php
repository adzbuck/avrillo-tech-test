<?php

namespace Tests\Unit\Repository;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_by_id_returns_null()
    {
        /** @var UserRepositoryInterface $userRepo */
        $userRepo = app(UserRepositoryInterface::class);

        $actualResult = $userRepo->fetchById(5);

        $this->assertNull($actualResult);
    }

    public function test_fetch_by_id_returns_model()
    {
        User::factory()
            ->createOne(['id' => 3]);

        /** @var UserRepositoryInterface $userRepo */
        $userRepo = app(UserRepositoryInterface::class);

        $actualResult = $userRepo->fetchById(3);

        $this->assertInstanceOf(User::class, $actualResult);
        $this->assertEquals(3, $actualResult->id);
        $this->assertDatabaseHas(User::class, $actualResult->getAttributes());
    }
}
