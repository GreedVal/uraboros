<?php

namespace App\Telegram\DTO\Response\Participants;

class UserDTO
{
    public function __construct(
        public string $type,
        public bool $self,
        public bool $contact,
        public bool $mutualContact,
        public bool $deleted,
        public bool $bot,
        public bool $botChatHistory,
        public bool $botNochats,
        public bool $verified,
        public bool $restricted,
        public bool $min,
        public bool $botInlineGeo,
        public bool $support,
        public bool $scam,
        public bool $applyMinPhoto,
        public bool $fake,
        public bool $botAttachMenu,
        public bool $premium,
        public bool $attachMenuEnabled,
        public bool $botCanEdit,
        public bool $closeFriend,
        public bool $storiesHidden,
        public bool $storiesUnavailable,
        public bool $contactRequirePremium,
        public bool $botBusiness,
        public bool $botHasMainApp,
        public int $id,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $username,
        public ?UserProfilePhotoDTO $photo,
        public ?UserStatusDTO $status,
        public ?EmojiStatusDTO $emojiStatus,
        public ?PeerColorDTO $color,
        public ?PeerColorDTO $profileColor,
        public ?int $storiesMaxId,
    ) {}
}
