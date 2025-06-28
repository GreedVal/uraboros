// Интерфейс для фотографии пользователя/чата
export interface IPhoto {
  _: string;
  has_video: boolean;
  personal: boolean;
  photo_id: string;
  stripped_thumb: {
    _: string;
    bytes: string;
  };
  dc_id: number;
}

// Интерфейс для информации о пересылке сообщения
export interface IForwardInfo {
  originalDate: number;
  originalChannelPost?: number;
  savedFromMsgId?: number | null;
  savedFromPeerId?: number | null;
  fromName?: string | null;
  import: boolean;
  hidden: boolean;
}

// Интерфейс для видео
export interface IVideo {
  id: string;
  duration: number;
  width: number;
  height: number;
  size: number;
  mimeType: string;
  thumbnail: any | null;
  supportsStreaming: boolean;
  isRound: boolean;
}

// Интерфейс для размера фото
export interface IPhotoSize {
  type: string;
  width: number;
  height: number;
  size: number;
}

// Интерфейс для медиа (фото, видео и т.д.)
export interface IMedia {
  type: string;
  photo?: {
    id: string;
    sizes: IPhotoSize[];
    date: number;
    dcId: number;
    hasStickers: boolean;
  } | null;
  video?: IVideo | null;
  document?: any | null;
  audio?: any | null;
  voice?: any | null;
  sticker?: any | null;
  location?: any | null;
  contact?: any | null;
  poll?: any | null;
  webpage?: any | null;
  caption?: string | null;
}

// Интерфейс для кнопки в разметке сообщения
export interface IKeyboardButton {
  _: string;
  text: string;
  url?: string;
}

// Интерфейс для строки кнопок в разметке сообщения
export interface IKeyboardButtonRow {
  _: string;
  buttons: IKeyboardButton[];
}

// Интерфейс для разметки сообщения
export interface IReplyMarkup {
  _: string;
  rows: IKeyboardButtonRow[];
}

// Интерфейс для сущности в тексте сообщения (жирный текст, ссылки и т.д.)
export interface IMessageEntity {
  _: string;
  offset: number;
  length: number;
  url?: string;
  collapsed?: boolean;
}

// Интерфейс для пользователя
export interface IUser {
  id: number;
  firstName: string;
  lastName: string | null;
  username: string | null;
  phone: string | null;
  isBot: boolean;
  isVerified: boolean;
  isPremium: boolean;
  langCode: string | null;
  photo: IPhoto | null;
}

// Интерфейс для чата/канала
export interface IChat {
  id: number;
  title: string;
  username: string | null;
  type: string;
  isMegagroup: boolean | null;
  isBroadcast: boolean | null;
  photo: string | null;
  isVerified: boolean;
  isRestricted: boolean;
  isScam: boolean;
  isFake: boolean;
  accessHash: string | null;
  participantsCount: number | null;
}

// Основной интерфейс для сообщения
export interface IMessage {
  id: number;
  fromId: number | null;
  peerId: number;
  replyToMsgId: number | null;
  date: number;
  text: string;
  isOutgoing: boolean;
  user: IUser | null;
  forwardInfo: IForwardInfo | null;
  media: IMedia | null;
  isPinned: boolean;
  noForwards: boolean;
  views: number;
  forwards: number;
  groupedId: any | null;
  chat: IChat | null;
  editDate: number | null;
  viaBotId: number | null;
  postAuthor: string | null;
  mentioned: boolean;
  scheduled: boolean;
  fromScheduled: boolean;
  silent: boolean;
  post: boolean;
  legacy: boolean;
  editHide: boolean;
  invertMedia: boolean;
  replyToTopId: number | null;
  replyToForumTopic: boolean | null;
  reactions: any | null;
  restrictionReason: any | null;
  ttlPeriod: number | null;
  quickReplyShortcutId: number | null;
  effect: any | null;
  replyMarkup: IReplyMarkup | null;
  entities: IMessageEntity[] | null;
  factCheck: any | null;
}

// Интерфейс для основного ответа API
export interface IMessagesResponse {
  count: number;
  chat: IChat[];
  messages: IMessage[];
}