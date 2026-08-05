<?php

namespace App\Events;

use App\Models\Consultation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PatientMessagesRead implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public Consultation $consultation,
        public int $lastReadMessageId,
    ) {
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel(
                'consultation.'.$this->consultation->public_id
            ),
        ];
    }

    public function broadcastAs(): string
    {
        return 'messages.read';
    }

    public function broadcastWith(): array
    {
        return [
            'consultation_public_id' => $this->consultation->public_id,
            'last_read_message_id' => $this->lastReadMessageId,
            'read_at' => $this->consultation->patient_read_at?->toIso8601String(),
        ];
    }
}
