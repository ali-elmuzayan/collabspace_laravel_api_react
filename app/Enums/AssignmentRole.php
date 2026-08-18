<?php

namespace App\Enums;

enum AssignmentRole: string
{
    case Editor = 'editor';
    case Viewer = 'viewer';
}
