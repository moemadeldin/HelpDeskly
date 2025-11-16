<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class MessageResource extends JsonResource
{
    public static $wrap = null; // This removes the "data" wrapper

    public function toArray(Request $request)
    {
        return [
            'success' => true,
            'message' => [
                'id' => (string) $this->_id,
                'ticket_id' => $this->ticket_id,
                'sender_id' => $this->sender_id,
                'sender_name' => $this->sender_name ?? auth()->user()->full_name,
                'role' => $this->role->value,
                'message' => $this->message,
                'created_at' => $this->created_at->toISOString(),
            ],
        ];
    }
}
