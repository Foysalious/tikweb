<?php

namespace App\Jobs;

use App\Http\Services\Dtos\UserDto;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class UserCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userDto;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userDto)
    {
        $this->userDto = $userDto;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserDto $userDto)
    {
        User::create([
            'name' => $this->userDto->name,
            'email' => $this->userDto->email,
            'role' => $this->userDto->role,
            'password' => Hash::make($this->userDto->password),
        ]);
    }
}
