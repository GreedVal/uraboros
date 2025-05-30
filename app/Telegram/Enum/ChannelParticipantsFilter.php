<?php

namespace App\Telegram\Enum;

enum ChannelParticipantsFilter: string
{
    case channelParticipantsRecent = 'channelParticipantsRecent';
    case channelParticipantsAdmins = 'channelParticipantsAdmins';
    case channelParticipantsKicked = 'channelParticipantsKicked';
    case channelParticipantsBots = 'channelParticipantsBots';
    case channelParticipantsBanned = 'channelParticipantsBanned';
    case channelParticipantsMentions = 'channelParticipantsMentions';

    public function description(): string
    {
        return match ($this) {
            self::channelParticipantsRecent => 'Недавние участники (все)',
            self::channelParticipantsAdmins => 'Администраторы канала/чата',
            self::channelParticipantsKicked => 'Исключённые пользователи',
            self::channelParticipantsBots => 'Боты',
            self::channelParticipantsBanned => 'Забаненные пользователи',
            self::channelParticipantsMentions => 'Пользователи, упомянутые в сообщениях',
        };
    }
}

