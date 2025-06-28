<script setup lang="ts">
import { type IMessage, type IChat, type IUser } from '@/types/messages';
import {
  ExternalLink,
  Pin,
  Image,
  Video,
  File,
  Smile,
  MapPin,
  Link,
  Reply,
  Forward,
  Eye,
  Edit,
  Timer,
  Bot,
  BadgeCheck,
} from 'lucide-vue-next';

const props = defineProps<{
  messages: IMessage[];
  chat: IChat[];
  users?: Record<number, IUser>;
}>();

const formatDate = (timestamp: number) => {
  return new Date(timestamp * 1000).toLocaleString('en-US', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  });
};

const formatDuration = (seconds: number) => {
  const mins = Math.floor(seconds / 60);
  const secs = Math.floor(seconds % 60);
  return `${mins}:${secs.toString().padStart(2, '0')}`;
};

const getFirstLetter = (str?: string) => str ? str.charAt(0).toUpperCase() : 'U';

const formatFileSize = (bytes: number) => `${Math.round(bytes / 1024)} KB`;

const getTelegramLink = (messageId: number) => {
  const chat = props.chat[0];
  const username = chat.username ? `${chat.username}` : `c/${chat.id}`;
  return `https://t.me/${username}/${messageId}`;
};
</script>

<template>
  <div class="space-y-4">
    <h4 class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">Messages:</h4>
    <div
      v-for="message in messages"
      :key="message.id"
      :id="`message-${message.id}`"
      class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-neutral-600 dark:bg-neutral-900 transition-all hover:border-gray-300 dark:hover:border-neutral-500"
    >
      <!-- Message header -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-3">
        <div class="flex items-center gap-2">
          <div class="relative h-8 w-8 shrink-0 overflow-hidden rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-neutral-600 dark:to-neutral-900">
            <div class="flex h-full w-full items-center justify-center text-sm font-medium text-indigo-600 dark:text-indigo-300">
              {{ getFirstLetter(message.user?.firstName ?? message.chat?.title) }}
            </div>
          </div>
          <div>
            <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
              <span class="font-medium text-gray-900 dark:text-white text-sm">
                {{ message.user?.firstName ?? message.chat?.title ?? 'Unknown' }}
                {{ message.user?.lastName ?? '' }}
              </span>
              <span class="text-xs text-gray-500 dark:text-gray-400">{{ message.fromId }}</span>
              <span v-if="message.user?.username" class="text-xs text-gray-500 dark:text-gray-400">
                @{{ message.user.username }}
              </span>
              <span v-if="message.user?.isBot" class="rounded-full bg-red-100 px-1.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900/30 dark:text-red-300 flex items-center">
                <Bot class="h-3 w-3 mr-0.5" />
                BOT
              </span>
              <span v-if="message.user?.isPremium" class="rounded-full bg-yellow-100 px-1.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300 flex items-center">
                <BadgeCheck class="h-3 w-3 mr-0.5" />
                PREMIUM
              </span>
            </div>
            <span v-if="message.viaBotId && users?.[message.viaBotId]" class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
              via @{{ users[message.viaBotId].username ?? users[message.viaBotId].firstName }}
            </span>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <a
            :href="getTelegramLink(message.id)"
            target="_blank"
            class="text-xs text-gray-500 hover:text-indigo-500 dark:hover:text-indigo-400 transition-colors flex items-center"
            title="Open in Telegram"
          >
            {{ formatDate(message.date) }}
            <ExternalLink class="h-3 w-3 ml-0.5" />
          </a>
          <span v-if="message.isPinned" class="rounded-full bg-indigo-100 px-1.5 py-0.5 text-xs font-medium text-indigo-800 dark:bg-neutral-600/30 dark:text-indigo-300 flex items-center">
            <Pin class="h-3 w-3 mr-0.5" />
            PINNED
          </span>
        </div>
      </div>

      <!-- Message content -->
      <div class="pl-10 space-y-3">
        <!-- Text content -->
        <p v-if="message.text" class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ message.text }}</p>

        <!-- Media attachments -->
        <div v-if="message.media" class="mt-2">
          <!-- Photo -->
          <div v-if="message.media.type === 'photo'" class="inline-flex items-center rounded-lg bg-gray-50 px-3 py-2 text-xs dark:bg-neutral-700/50">
            <Image class="h-4 w-4 mr-2 text-indigo-600 dark:text-indigo-400" />
            <span class="text-gray-700 dark:text-gray-300">Photo</span>
            <a :href="getTelegramLink(message.id)" target="_blank" class="ml-2 text-xs text-indigo-600 hover:underline dark:text-indigo-400">
              (open in Telegram)
            </a>
          </div>

          <!-- Video -->
          <div v-else-if="message.media.type === 'video'" class="inline-flex items-center rounded-lg bg-gray-50 px-3 py-2 text-xs dark:bg-neutral-700/50">
            <Video class="h-4 w-4 mr-2 text-indigo-600 dark:text-indigo-400" />
            <span class="text-gray-700 dark:text-gray-300">Video</span>
            <span v-if="message.media.video?.duration" class="ml-2 text-xs text-gray-500 dark:text-gray-400">
              ({{ formatDuration(message.media.video.duration) }})
            </span>
            <a :href="getTelegramLink(message.id)" target="_blank" class="ml-2 text-xs text-indigo-600 hover:underline dark:text-indigo-400">
              (open in Telegram)
            </a>
          </div>

          <!-- Document -->
          <div v-else-if="message.media.type === 'document'" class="inline-flex items-center rounded-lg bg-gray-50 px-3 py-2 text-xs dark:bg-neutral-700/50">
            <File class="h-4 w-4 mr-2 text-indigo-600 dark:text-indigo-400" />
            <span class="text-gray-700 dark:text-gray-300">
              Document: {{ message.media.document?.fileName ?? 'File' }}
            </span>
            <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">
              ({{ message.media.document?.fileExtension?.toUpperCase() ?? 'FILE' }},
              {{ formatFileSize(message.media.document?.size ?? 0) }})
            </span>
            <a :href="getTelegramLink(message.id)" target="_blank" class="ml-2 text-xs text-indigo-600 hover:underline dark:text-indigo-400">
              (open in Telegram)
            </a>
          </div>

          <!-- Sticker -->
          <div v-else-if="message.media.type === 'sticker'" class="inline-flex items-center rounded-lg bg-gray-50 px-3 py-2 text-xs dark:bg-neutral-700/50">
            <Smile class="h-4 w-4 mr-2 text-indigo-600 dark:text-indigo-400" />
            <span class="text-gray-700 dark:text-gray-300">Sticker</span>
            <a :href="getTelegramLink(message.id)" target="_blank" class="ml-2 text-xs text-indigo-600 hover:underline dark:text-indigo-400">
              (open in Telegram)
            </a>
          </div>

          <!-- Location -->
          <div v-else-if="message.media.type === 'location'" class="inline-flex items-center rounded-lg bg-gray-50 px-3 py-2 text-xs dark:bg-neutral-700/50">
            <MapPin class="h-4 w-4 mr-2 text-indigo-600 dark:text-indigo-400" />
            <span class="text-gray-700 dark:text-gray-300">
              Location: {{ message.media.location?.lat }}, {{ message.media.location?.long }}
            </span>
            <a
              v-if="message.media.location"
              :href="`https://maps.google.com/?q=${message.media.location.lat},${message.media.location.long}`"
              target="_blank"
              class="ml-2 text-xs text-indigo-600 hover:underline dark:text-indigo-400"
            >
              (open in Google Maps)
            </a>
          </div>

          <!-- Other media types -->
          <div v-else class="inline-flex items-center rounded-lg bg-gray-50 px-3 py-2 text-xs dark:bg-neutral-700/50">
            <Link class="h-4 w-4 mr-2 text-indigo-600 dark:text-indigo-400" />
            <span class="text-gray-700 dark:text-gray-300">Media attachment ({{ message.media.type }})</span>
            <a :href="getTelegramLink(message.id)" target="_blank" class="ml-2 text-xs text-indigo-600 hover:underline dark:text-indigo-400">
              (open in Telegram)
            </a>
          </div>
        </div>

        <!-- Message metadata -->
        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-gray-500 dark:text-gray-400 mt-2">
          <!-- Reply -->
          <a
            v-if="message.replyToMsgId"
            :href="getTelegramLink(message.replyToMsgId)"
            target="_blank"
            class="text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors flex items-center"
          >
            <Reply class="h-3 w-3 mr-1" />
            Reply to #{{ message.replyToMsgId }}
          </a>

          <!-- Forwarded -->
          <span v-if="message.forwardInfo" class="flex items-center">
            <Forward class="h-3 w-3 mr-1" />
            Forwarded
            <span v-if="message.forwardInfo.fromName">
              from {{ message.forwardInfo.fromName }}
            </span>
          </span>

          <!-- Views -->
          <span v-if="message.views > 0" class="flex items-center">
            <Eye class="h-3 w-3 mr-1" />
            {{ message.views }}
          </span>

          <!-- Forwards -->
          <span v-if="message.forwards > 0" class="flex items-center">
            <Forward class="h-3 w-3 mr-1" />
            {{ message.forwards }}
          </span>

          <!-- Edited -->
          <span v-if="message.editDate" class="flex items-center" :title="`Edited at ${formatDate(message.editDate)}`">
            <Edit class="h-3 w-3 mr-1" />
            edited
          </span>

          <!-- TTL -->
          <span v-if="message.ttlPeriod" class="flex items-center text-red-500 dark:text-red-400">
            <Timer class="h-3 w-3 mr-1" />
            Self-destruct in {{ message.ttlPeriod }} sec
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
