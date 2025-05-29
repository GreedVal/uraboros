<?php

namespace App\Telegram\Enum;

enum ChannelParticipantsFilter: string
{
    case RECENT = 'channelParticipantsRecent';
    case ADMINS = 'channelParticipantsAdmins';
    case KICKED = 'channelParticipantsKicked';
    case BOTS = 'channelParticipantsBots';
    case MENTIONS = 'channelParticipantsMentions';
    case SEARCH = 'channelParticipantsSearch';
}
