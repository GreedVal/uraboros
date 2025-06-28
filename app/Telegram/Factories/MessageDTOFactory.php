<?php

namespace App\Telegram\Factories;

use App\Telegram\DTO\Response\Messages\{
    MessageDTO,
    UserDTO,
    ForwardInfoDTO,
    MediaDTO,
    PhotoDTO,
    DocumentDTO,
    VideoDTO,
    AudioDTO,
    VoiceDTO,
    StickerDTO,
    ChatDTO,
    LocationDTO,
    ContactDTO,
    PollDTO,
    WebPageDTO,
    ReactionsDTO,
    ReactionDTO
};

class MessageDTOFactory
{
    public static function createFromArray(array $data, array $users = [], array $chats = []): MessageDTO
    {
        return new MessageDTO(
            id: $data['id'],
            fromId: $data['from_id'] ?? 0,
            peerId: $data['peer_id'],
            replyToMsgId: $data['reply_to']['reply_to_msg_id'] ?? null,
            date: $data['date'],
            text: $data['message'] ?? '',
            isOutgoing: $data['out'] ?? false,
            user: self::createUserDTO($data, $users),
            forwardInfo: self::createForwardInfoDTO($data),
            media: self::createMediaDTO($data),
            chat: self::createChatDTO($data, $chats),
            isPinned: $data['pinned'] ?? false,
            noForwards: $data['noforwards'] ?? false,
            views: $data['views'] ?? 0,
            forwards: $data['forwards'] ?? 0,
            groupedId: $data['grouped_id'] ?? null,
            viaBotId: $data['via_bot_id'] ?? null,
            editDate: $data['edit_date'] ?? null,
            postAuthor: $data['post_author'] ?? null,
            mentioned: $data['mentioned'] ?? false,
            scheduled: $data['scheduled'] ?? false,
            fromScheduled: $data['from_scheduled'] ?? false,
            silent: $data['silent'] ?? false,
            post: $data['post'] ?? false,
            legacy: $data['legacy'] ?? false,
            editHide: $data['edit_hide'] ?? false,
            invertMedia: $data['invert_media'] ?? false,
            replyToTopId: $data['reply_to']['reply_to_top_id'] ?? null,
            replyToForumTopic: $data['reply_to']['reply_to_forum_topic'] ?? null,
            reactions: self::createReactionsDTO($data['reactions'] ?? null),
            restrictionReason: $data['restriction_reason'] ?? null,
            ttlPeriod: $data['ttl_period'] ?? null,
            quickReplyShortcutId: $data['quick_reply_shortcut_id'] ?? null,
            effect: $data['effect'] ?? null,
            replyMarkup: $data['reply_markup'] ?? null,
            entities: $data['entities'] ?? null,
            factCheck: $data['fact_check'] ?? null
        );
    }

    private static function createReactionsDTO(?array $reactionsData): ?ReactionsDTO
    {
        if (!$reactionsData) {
            return null;
        }

        $reactions = [];
        foreach ($reactionsData['reactions'] ?? [] as $reaction) {
            $reactions[] = new ReactionDTO(
                emoticon: $reaction['emoticon'],
                count: $reaction['count'],
                chosen: $reaction['chosen'] ?? false
            );
        }

        return new ReactionsDTO(
            canSeeList: $reactionsData['can_see_list'] ?? false,
            reactions: $reactions,
            count: $reactionsData['count'] ?? 0,
            recentReaction: $reactionsData['recent_reaction'] ?? null
        );
    }

    private static function createUserDTO(array $data, array $users): ?UserDTO
    {
        if (!isset($data['from_id']) || !isset($users[$data['from_id']])) {
            return null;
        }

        $userData = $users[$data['from_id']];

        return new UserDTO(
            id: $userData['id'],
            firstName: $userData['first_name'] ?? null,
            lastName: $userData['last_name'] ?? null,
            username: $userData['username'] ?? null,
            phone: $userData['phone'] ?? null,
            isBot: $userData['bot'] ?? false,
            isVerified: $userData['verified'] ?? false,
            isPremium: $userData['premium'] ?? false,
            langCode: $userData['lang_code'] ?? null,
            photo: $userData['photo'] ?? null
        );
    }

    private static function createForwardInfoDTO(array $data): ?ForwardInfoDTO
    {
        if (!isset($data['fwd_from'])) {
            return null;
        }

        $fwd = $data['fwd_from'];

        return new ForwardInfoDTO(
            originalDate: $fwd['date'] ?? null,
            originalChannelPost: $fwd['channel_post'] ?? null,
            savedFromMsgId: $fwd['saved_from_msg_id'] ?? null,
            savedFromPeerId: $fwd['saved_from_peer']['channel_id'] ?? $fwd['from_id'] ?? null,
            fromName: $fwd['from_name'] ?? null,
            import: $fwd['imported'] ?? false,
            hidden: $fwd['hidden'] ?? false
        );
    }

    private static function createMediaDTO(array $data): ?MediaDTO
    {
        if (!isset($data['media'])) {
            return null;
        }

        $mediaData = $data['media'];
        $caption = $mediaData['caption'] ?? null;

        switch ($mediaData['_']) {
            case 'messageMediaPhoto':
                if (isset($mediaData['photo'])) {
                    return new MediaDTO(
                        type: 'photo',
                        photo: self::createPhotoDTO($mediaData),
                        caption: $caption
                    );
                }
                break;

            case 'messageMediaDocument':
                if (isset($mediaData['document'])) {
                    return self::createDocumentMediaDTO($mediaData, $caption);
                }
                break;

            case 'messageMediaGeo':
                if (isset($mediaData['geo'])) {
                    return new MediaDTO(
                        type: 'location',
                        location: new LocationDTO(
                            lat: $mediaData['geo']['lat'],
                            long: $mediaData['geo']['long'],
                            accuracyRadius: $mediaData['geo']['accuracy_radius'] ?? null
                        )
                    );
                }
                break;

            case 'messageMediaContact':
                return new MediaDTO(
                    type: 'contact',
                    contact: new ContactDTO(
                        phone: $mediaData['phone_number'],
                        firstName: $mediaData['first_name'],
                        lastName: $mediaData['last_name'] ?? null,
                        userId: $mediaData['user_id'] ?? null
                    )
                );

            case 'messageMediaPoll':
                return new MediaDTO(
                    type: 'poll',
                    poll: new PollDTO(
                        id: $mediaData['poll']['id'],
                        question: $mediaData['poll']['question'],
                        options: $mediaData['poll']['options'],
                        totalVoters: $mediaData['poll']['total_voters'] ?? 0,
                        closed: $mediaData['poll']['closed'] ?? false,
                        multiple: $mediaData['poll']['multiple_choice'] ?? false
                    )
                );

            case 'messageMediaWebPage':
                return new MediaDTO(
                    type: 'webpage',
                    webpage: new WebPageDTO(
                        url: $mediaData['url'] ?? null,
                        displayUrl: $mediaData['display_url'] ?? null,
                        title: $mediaData['title'] ?? null,
                        description: $mediaData['description'] ?? null,
                        photo: isset($mediaData['photo']) ? self::createPhotoDTO($mediaData) : null
                    )
                );
        }

        return null;
    }

    private static function createDocumentMediaDTO(array $mediaData, ?string $caption): ?MediaDTO
    {
        $document = $mediaData['document'];
        $attributes = [];

        foreach ($document['attributes'] ?? [] as $attr) {
            $attributes[$attr['_']] = $attr;
        }

        if (isset($attributes['documentAttributeSticker'])) {
            return new MediaDTO(
                type: 'sticker',
                sticker: new StickerDTO(
                    id: $document['id'],
                    alt: $attributes['documentAttributeSticker']['alt'],
                    stickerSetId: $attributes['documentAttributeSticker']['stickerset']['id'] ?? null,
                    thumbnail: self::createPhotoDTO(['photo' => $document])
                )
            );
        }

        if (isset($attributes['documentAttributeVideo'])) {
            return new MediaDTO(
                type: 'video',
                video: new VideoDTO(
                    id: $document['id'],
                    duration: $attributes['documentAttributeVideo']['duration'],
                    width: $attributes['documentAttributeVideo']['w'],
                    height: $attributes['documentAttributeVideo']['h'],
                    size: $document['size'],
                    mimeType: $document['mime_type'],
                    thumbnail: isset($document['thumb']) ? self::createPhotoDTO(['photo' => $document['thumb']]) : null,
                    supportsStreaming: $attributes['documentAttributeVideo']['supports_streaming'] ?? false,
                    isRound: $attributes['documentAttributeVideo']['round_message'] ?? false
                ),
                caption: $caption
            );
        }

        if (isset($attributes['documentAttributeAudio'])) {
            $audioAttr = $attributes['documentAttributeAudio'];

            if ($audioAttr['voice'] ?? false) {
                return new MediaDTO(
                    type: 'voice',
                    voice: new VoiceDTO(
                        id: $document['id'],
                        duration: $audioAttr['duration'],
                        size: $document['size'],
                        mimeType: $document['mime_type'],
                        waveform: $audioAttr['waveform'] ?? null
                    )
                );
            }

            return new MediaDTO(
                type: 'audio',
                audio: new AudioDTO(
                    id: $document['id'],
                    duration: $audioAttr['duration'],
                    title: $audioAttr['title'] ?? null,
                    performer: $audioAttr['performer'] ?? null,
                    size: $document['size'],
                    mimeType: $document['mime_type']
                ),
                caption: $caption
            );
        }

        if (isset($attributes['documentAttributeAnimated'])) {
            return new MediaDTO(
                type: 'gif',
                document: self::createDocumentDTO($document),
                caption: $caption
            );
        }

        return new MediaDTO(
            type: 'document',
            document: self::createDocumentDTO($document),
            caption: $caption
        );
    }

    private static function createDocumentDTO(array $documentData): DocumentDTO
    {
        $attributes = [];
        foreach ($documentData['attributes'] ?? [] as $attr) {
            $attributes[$attr['_']] = $attr;
        }

        return new DocumentDTO(
            id: $documentData['id'],
            accessHash: $documentData['access_hash'],
            date: $documentData['date'],
            mimeType: $documentData['mime_type'],
            size: $documentData['size'],
            fileName: $attributes['documentAttributeFilename']['file_name'] ?? null,
            fileExtension: pathinfo($attributes['documentAttributeFilename']['file_name'] ?? '', PATHINFO_EXTENSION) ?: null,
            dcId: $documentData['dc_id'],
            attributes: $attributes,
            thumbnail: isset($documentData['thumb']) ? self::createPhotoDTO(['photo' => $documentData['thumb']]) : null
        );
    }

    private static function createPhotoDTO(array $mediaData): PhotoDTO
    {
        $photo = $mediaData['photo'];
        $sizes = [];

        if(isset($photo['sizes'])) {
            foreach ($photo['sizes'] as $size) {
                $sizes[] = [
                    'type' => $size['type'],
                    'width' => $size['w'] ?? 0,
                    'height' => $size['h'] ?? 0,
                    'size' => $size['size'] ?? 0
                ];
            }
        }

        return new PhotoDTO(
            id: $photo['id'],
            sizes: $sizes ?? [],
            date: $photo['date'],
            dcId: $photo['dc_id'],
            hasStickers: $photo['has_stickers'] ?? false
        );
    }

    private static function createChatDTO(array $data, array $chats): ?ChatDTO
    {
        $peerId = $data['peer_id'] ?? null;

        if (!$peerId || !isset($chats[$peerId])) {
            return null;
        }

        $chatData = $chats[$peerId];

        return new ChatDTO(
            id: $chatData['id'],
            title: $chatData['title'],
            username: $chatData['username'] ?? null,
            type: match($chatData['_']) {
                'channel' => 'channel',
                'chat' => 'chat',
                default => 'group'
            },
            isMegagroup: $chatData['megagroup'] ?? false,
            isBroadcast: $chatData['broadcast'] ?? false,
            photo: $chatData['photo']['photo_id'] ?? null,
            isVerified: $chatData['verified'] ?? false,
            isRestricted: $chatData['restricted'] ?? false,
            isScam: $chatData['scam'] ?? false,
            isFake: $chatData['fake'] ?? false,
            accessHash: $chatData['access_hash'] ?? null,
            participantsCount: $chatData['participants_count'] ?? null
        );
    }
}
