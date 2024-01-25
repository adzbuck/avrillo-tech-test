<?php

namespace App\Console\Commands;

use App\Repository\UserRepositoryInterface;
use Illuminate\Console\Command;

class GetAuthToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-auth-token {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets the authentication token for a user';

    public function __construct(
        public readonly UserRepositoryInterface $userRepository
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = (int) $this->argument('user');

        if (!$userId) {
            $this->error('User id is required!');
        }

        $user = $this->userRepository->fetchById($userId);

        if (!$user) {
            $this->error('User not found');
        }

        $this->info($user->api_token);
    }
}
