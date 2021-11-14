<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\ModifyRequest;

class ModifyRequestService
{
    private $modifyRequest;

    /**
     * @param ModifyRequest $modifyRequest
     */
    public function __construct(ModifyRequest $modifyRequest)
    {
        $this->modifyRequest = $modifyRequest;
    }

    /**
     * @param array $input
     * @param integer $userId
     * @return void
     */
    public function store(array $input, int $userId): void
    {
        $this->modifyRequest->user_id = $userId;
        $this->modifyRequest->fill($input)->save();
    }
}
