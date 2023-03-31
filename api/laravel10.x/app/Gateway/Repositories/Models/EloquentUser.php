<?php

namespace App\Gateway\Repositories\Models;

use App\Domain\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentUser extends Model
{
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'users';

    protected $fillable = ['name', 'email'];

    public function toDomainEntity(): User
    {
        return new User(
            $this->name,
            $this->email
        );
    }

    public static function fromDomainEntity(User $user): self
    {
        return new self([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ]);
    }
}
