<?php

namespace App\Enums;

enum ProjectMemberRole: string
{
    case Admin = 'admin';
    case Editor = 'editor';
    case Viewer = 'viewer';
}
