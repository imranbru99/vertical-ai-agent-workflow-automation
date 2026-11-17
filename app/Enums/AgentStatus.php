<?php

namespace App\Enums;

enum AgentStatus: string
{
    case Idle = 'idle';
    case Running = 'running';
    case Failed = 'failed';
    case Training = 'training';

    /** @return array<string, string> */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $status) => [$status->value => ucfirst($status->value)])
            ->all();
    }
}
