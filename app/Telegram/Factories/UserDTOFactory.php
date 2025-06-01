<?php

namespace App\Telegram\Factories;

use App\Telegram\DTO\Response\Participants\UserDTO;
use App\Telegram\DTO\Response\Participants\UserProfilePhotoDTO;
use App\Telegram\DTO\Response\Participants\UserStatusDTO;
use App\Telegram\DTO\Response\Participants\EmojiStatusDTO;
use App\Telegram\DTO\Response\Participants\PeerColorDTO;

class UserDTOFactory
{
    public static function createFromArray(array $data): UserDTO
    {
        return new UserDTO(
            type: $data['_'] ?? '',
            self: $data['self'] ?? false,
            contact: $data['contact'] ?? false,
            mutualContact: $data['mutual_contact'] ?? false,
            deleted: $data['deleted'] ?? false,
            bot: $data['bot'] ?? false,
            botChatHistory: $data['bot_chat_history'] ?? false,
            botNochats: $data['bot_nochats'] ?? false,
            verified: $data['verified'] ?? false,
            restricted: $data['restricted'] ?? false,
            min: $data['min'] ?? false,
            botInlineGeo: $data['bot_inline_geo'] ?? false,
            support: $data['support'] ?? false,
            scam: $data['scam'] ?? false,
            applyMinPhoto: $data['apply_min_photo'] ?? false,
            fake: $data['fake'] ?? false,
            botAttachMenu: $data['bot_attach_menu'] ?? false,
            premium: $data['premium'] ?? false,
            attachMenuEnabled: $data['attach_menu_enabled'] ?? false,
            botCanEdit: $data['bot_can_edit'] ?? false,
            closeFriend: $data['close_friend'] ?? false,
            storiesHidden: $data['stories_hidden'] ?? false,
            storiesUnavailable: $data['stories_unavailable'] ?? false,
            contactRequirePremium: $data['contact_require_premium'] ?? false,
            botBusiness: $data['bot_business'] ?? false,
            botHasMainApp: $data['bot_has_main_app'] ?? false,
            id: $data['id'] ?? 0,
            firstName: $data['first_name'] ?? null,
            lastName: $data['last_name'] ?? null,
            username: $data['username'] ?? null,
            photo: isset($data['photo']) ? self::createUserProfilePhoto($data['photo']) : null,
            status: isset($data['status']) ? self::createUserStatus($data['status']) : null,
            emojiStatus: isset($data['emoji_status']) ? self::createEmojiStatus($data['emoji_status']) : null,
            color: isset($data['color']) ? self::createPeerColor($data['color']) : null,
            profileColor: isset($data['profile_color']) ? self::createPeerColor($data['profile_color']) : null,
            storiesMaxId: $data['stories_max_id'] ?? null
        );
    }

    private static function createUserProfilePhoto(array $data): UserProfilePhotoDTO
    {
        return new UserProfilePhotoDTO(
            type: $data['_'] ?? '',
            hasVideo: $data['has_video'] ?? false,
            personal: $data['personal'] ?? false,
            photoId: $data['photo_id'] ?? '',
            strippedThumb: $data['stripped_thumb'] ?? '',
            dcId: $data['dc_id'] ?? 0
        );
    }

    private static function createUserStatus(array $data): UserStatusDTO
    {
        return new UserStatusDTO(
            type: $data['_'] ?? '',
            byMe: $data['by_me'] ?? null
        );
    }

    private static function createEmojiStatus(array $data): EmojiStatusDTO
    {
        return new EmojiStatusDTO(
            type: $data['_'] ?? '',
            documentId: $data['document_id'] ?? ''
        );
    }

    private static function createPeerColor(array $data): PeerColorDTO
    {
        return new PeerColorDTO(
            type: $data['_'] ?? '',
            color: $data['color'] ?? 0,
            backgroundEmojiId: $data['background_emoji_id'] ?? null
        );
    }
}
