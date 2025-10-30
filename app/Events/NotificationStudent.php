<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationStudent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $student;
    public $absents;
    public $presents;
    public $studentStatus;

    public function __construct($absents, $presents, $student, $studentStatus)
    {
        $this->absents = $absents;
        $this->presents = $presents;
        $this->student = $student;
        $this->studentStatus = $studentStatus;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("notification-student.{$this->student->id}"),
        ];
    }

    public function broadcastAs(){

        return 'notification-received-student';
    }

    public function broadcastWith(){

        return [

            'student' => $this->student->id,
            'absents' => $this->absents,
            'presents' => $this->presents,
            'studentStatus' => $this->studentStatus
        ];
    }

}
