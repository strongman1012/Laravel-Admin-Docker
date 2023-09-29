<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

class WorkType extends Enum
{
    const WORK_START = 8;
    const WORK_END = 22;

    const WORKER_MIN = 0;
    const WORKER_MAX = 9;
    const VOLUME_MIN = 0;
    const VOLUME_MAX = 99;
}
