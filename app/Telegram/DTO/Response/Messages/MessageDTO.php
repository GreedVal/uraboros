<?php

namespace App\Telegram\DTO\Response\Messages;

class MessageDTO
{
    public function __construct(
        public int $id,
        public int $fromId,
        public int $peerId,
        public ?int $replyToMsgId,
        public int $date,
        public string $text,
        public bool $isOutgoing,
        public ?UserDTO $user = null,
        public ?ForwardInfoDTO $forwardInfo = null,
        public ?MediaDTO $media = null,
        public bool $isPinned = false,
        public bool $noForwards = false,
        public int $views = 0,
        public int $forwards = 0,
        public ?string $groupedId = null,
        public ?ChatDTO $chat = null,
        public ?int $editDate = null,
        public ?int $viaBotId = null,
        public ?string $postAuthor = null,
        public bool $mentioned = false,
        public bool $scheduled = false,
        public bool $fromScheduled = false,
        public bool $silent = false,
        public bool $post = false,
        public bool $legacy = false,
        public bool $editHide = false,
        public bool $invertMedia = false,
        public ?int $replyToTopId = null,
        public ?int $replyToForumTopic = null,
        public ?ReactionsDTO $reactions = null,
        public ?array $restrictionReason = null,
        public ?int $ttlPeriod = null,
        public ?int $quickReplyShortcutId = null,
        public ?int $effect = null,
        public ?array $replyMarkup = null,
        public ?array $entities = null,
        public ?array $factCheck = null
    ) {}
}
