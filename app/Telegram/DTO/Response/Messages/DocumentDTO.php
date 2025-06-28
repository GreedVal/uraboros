<?php

namespace App\Telegram\DTO\Response\Messages;

class DocumentDTO
{
    public function __construct(
        public string $id,
        public int $accessHash,
        public int $date,
        public string $mimeType,
        public int $size,
        public ?string $fileName = null,
        public ?string $fileExtension = null,
        public ?int $dcId = null,
        public ?array $attributes = null, // массив атрибутов документа
        public ?PhotoDTO $thumbnail = null // миниатюра документа
    ) {}
}
