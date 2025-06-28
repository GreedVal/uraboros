<?php

namespace App\Telegram\Factories;

use App\Telegram\DTO\Response\Participants\UserDTO;
use App\Telegram\DTO\Response\Participants\UserProfilePhotoDTO;
use App\Telegram\DTO\Response\Participants\UserStatusDTO;
use App\Telegram\DTO\Response\Participants\EmojiStatusDTO;
use App\Telegram\DTO\Response\Participants\PeerColorDTO;
use InvalidArgumentException;

class UserDTOFactory
{
    public static function createFromArray(array $data): UserDTO
    {
        self::validateInputData($data);

        return new UserDTO(
            type: self::sanitizeString($data['_'] ?? ''),
            self: self::sanitizeBoolean($data['self'] ?? false),
            contact: self::sanitizeBoolean($data['contact'] ?? false),
            mutualContact: self::sanitizeBoolean($data['mutual_contact'] ?? false),
            deleted: self::sanitizeBoolean($data['deleted'] ?? false),
            bot: self::sanitizeBoolean($data['bot'] ?? false),
            botChatHistory: self::sanitizeBoolean($data['bot_chat_history'] ?? false),
            botNochats: self::sanitizeBoolean($data['bot_nochats'] ?? false),
            verified: self::sanitizeBoolean($data['verified'] ?? false),
            restricted: self::sanitizeBoolean($data['restricted'] ?? false),
            min: self::sanitizeBoolean($data['min'] ?? false),
            botInlineGeo: self::sanitizeBoolean($data['bot_inline_geo'] ?? false),
            support: self::sanitizeBoolean($data['support'] ?? false),
            scam: self::sanitizeBoolean($data['scam'] ?? false),
            applyMinPhoto: self::sanitizeBoolean($data['apply_min_photo'] ?? false),
            fake: self::sanitizeBoolean($data['fake'] ?? false),
            botAttachMenu: self::sanitizeBoolean($data['bot_attach_menu'] ?? false),
            premium: self::sanitizeBoolean($data['premium'] ?? false),
            attachMenuEnabled: self::sanitizeBoolean($data['attach_menu_enabled'] ?? false),
            botCanEdit: self::sanitizeBoolean($data['bot_can_edit'] ?? false),
            closeFriend: self::sanitizeBoolean($data['close_friend'] ?? false),
            storiesHidden: self::sanitizeBoolean($data['stories_hidden'] ?? false),
            storiesUnavailable: self::sanitizeBoolean($data['stories_unavailable'] ?? false),
            contactRequirePremium: self::sanitizeBoolean($data['contact_require_premium'] ?? false),
            botBusiness: self::sanitizeBoolean($data['bot_business'] ?? false),
            botHasMainApp: self::sanitizeBoolean($data['bot_has_main_app'] ?? false),
            id: self::sanitizeInteger($data['id'] ?? 0),
            firstName: isset($data['first_name']) ? self::sanitizeString($data['first_name']) : null,
            lastName: isset($data['last_name']) ? self::sanitizeString($data['last_name']) : null,
            username: isset($data['username']) ? self::sanitizeString($data['username']) : null,
            photo: isset($data['photo']) ? self::createUserProfilePhoto($data['photo']) : null,
            status: isset($data['status']) ? self::createUserStatus($data['status']) : null,
            emojiStatus: isset($data['emoji_status']) ? self::createEmojiStatus($data['emoji_status']) : null,
            color: isset($data['color']) ? self::createPeerColor($data['color']) : null,
            profileColor: isset($data['profile_color']) ? self::createPeerColor($data['profile_color']) : null,
            storiesMaxId: isset($data['stories_max_id']) ? self::sanitizeInteger($data['stories_max_id']) : null
        );
    }

    private static function createUserProfilePhoto(array $data): UserProfilePhotoDTO
    {
        return new UserProfilePhotoDTO(
            type: self::sanitizeString($data['_'] ?? ''),
            hasVideo: self::sanitizeBoolean($data['has_video'] ?? false),
            personal: self::sanitizeBoolean($data['personal'] ?? false),
            photoId: self::sanitizeString($data['photo_id'] ?? ''),
            strippedThumb: isset($data['stripped_thumb']) ? self::sanitizeBase64($data['stripped_thumb']) : '',
            dcId: self::sanitizeInteger($data['dc_id'] ?? 0)
        );
    }

    private static function createUserStatus(array $data): UserStatusDTO
    {
        return new UserStatusDTO(
            type: self::sanitizeString($data['_'] ?? ''),
            byMe: isset($data['by_me']) ? self::sanitizeBoolean($data['by_me']) : null
        );
    }

    private static function createEmojiStatus(array $data): EmojiStatusDTO
    {
        return new EmojiStatusDTO(
            type: self::sanitizeString($data['_'] ?? ''),
            documentId: self::sanitizeString($data['document_id'] ?? '')
        );
    }

    private static function createPeerColor(array $data): PeerColorDTO
    {
        return new PeerColorDTO(
            type: self::sanitizeString($data['_'] ?? ''),
            color: self::sanitizeInteger($data['color'] ?? 0),
            backgroundEmojiId: isset($data['background_emoji_id']) ? self::sanitizeString($data['background_emoji_id']) : null
        );
    }

    private static function validateInputData(array $data): void
    {
        if (!isset($data['id'])) {
            throw new InvalidArgumentException('User data must contain an id field');
        }
    }

    private static function sanitizeString(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        // Remove invalid UTF-8 characters
        $cleaned = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        
        return htmlspecialchars($cleaned, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    private static function sanitizeBoolean(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    private static function sanitizeInteger(mixed $value): int
    {
        return filter_var($value, FILTER_VALIDATE_INT) ?: 0;
    }

    private static function sanitizeBase64(mixed $value): string
    {
        if (base64_encode(base64_decode($value, true)) === $value) {
            return $value;
        }
        
        return base64_encode($value);
    }
}