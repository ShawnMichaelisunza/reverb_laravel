<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('notification-student.{studentId}', function ($student, $studentId) {
    return (int) $student->id === (int) $studentId;
});
