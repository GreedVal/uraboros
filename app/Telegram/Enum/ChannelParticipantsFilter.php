<?php

namespace App\Telegram\Enum;

enum ChannelParticipantsFilter: string
{
    case channelParticipantsRecent = 'channelParticipantsRecent';
    case channelParticipantsAdmins = 'channelParticipantsAdmins';
    case channelParticipantsBots = 'channelParticipantsBots';

    public function description(): string
    {
        return match ($this) {
            self::channelParticipantsRecent => 'Недавние участники (все)',
            self::channelParticipantsAdmins => 'Администраторы канала/чата',
            self::channelParticipantsBots => 'Боты',
        };
    }
}

