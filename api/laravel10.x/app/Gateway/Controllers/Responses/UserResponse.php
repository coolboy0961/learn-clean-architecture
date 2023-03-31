<?php

namespace App\Gateway\Controllers\Responses;

use App\Domain\Entities\User;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

class UserResponse implements JsonSerializable
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function collection(array $users): array
    {
        return array_map(function (User $user) {
            return new self($user);
        }, $users);
    }

    /**
     * Specify data which should be serialized to JSON
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @return mixed Returns data which can be serialized by json_encode(), which is a value of any type other than a resource .
     */
    public function jsonSerialize()
    {
        $data = [
            'name' => $this->user->getName(),
            'email' => $this->user->getEmail()
        ];
        // phoneNumber プロパティが null 以外の場合に限り、配列に追加する
        if ($this->user->getPhoneNumber() !== null) {
            $data['phoneNumber'] = $this->user->getPhoneNumber();
        }
        return $data;
    }
}
