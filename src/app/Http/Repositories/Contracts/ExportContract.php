<?php

namespace App\Http\Repositories\Contracts;

interface ExportContract
{
    public function export($type, $format);
}
