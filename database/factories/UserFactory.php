<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password = null;


    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
        ];
    }


    public function unverified(): static
    {
        return $this->state(fn (array $attributes): array => [
            'email_verified_at' => null,
        ]);
    }


    public function withRole(string $roleName, string $guard = 'web'): static
    {
        return $this->afterCreating(function (User $user) use ($roleName, $guard): void {
            app(PermissionRegistrar::class)->forgetCachedPermissions();

            Role::firstOrCreate([
                'name'       => $roleName,
                'guard_name' => $guard,
            ]);

            $user->assignRole($roleName);
        });
    }


    public function superAdmin(string $guard = 'web'): static
    {
        return $this->withRole('Super Admin', $guard);
    }


    public function asUser(string $guard = 'web'): static
    {
        return $this->withRole('User', $guard);
    }
}
