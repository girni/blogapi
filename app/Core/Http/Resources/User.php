<?php

namespace BlogApi\Core\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    private $token;

    public function __construct(\BlogApi\Core\Model\User $resource, ?string $token = null)
    {
        parent::__construct($resource);

        $this->token = $token;
    }

    public function toArray($request)
    {
        return [
            'user' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'email_verified_at' => $this->email_verified_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'token' => $this->token
        ];
    }
}