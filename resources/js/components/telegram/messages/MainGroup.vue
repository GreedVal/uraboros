<script setup lang="ts">
import { computed } from 'vue';
import { type IChat } from '@/types/messages';
import { MessageSquare, Users, Verified, Lock } from 'lucide-vue-next';

const props = defineProps<{
  chat: IChat;
}>();

const firstLetter = computed(() => props.chat.title.charAt(0).toUpperCase());
const chatType = computed(() => {
  if (props.chat.isMegagroup) return 'Supergroup';
  if (props.chat.isBroadcast) return 'Channel';
  return 'Chat';
});
</script>

<template>
  <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-neutral-600 dark:bg-neutral-900 mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
      <div class="flex items-center gap-3">
        <div class="relative h-10 w-10 shrink-0 overflow-hidden rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-neutral-600 dark:to-neutral-900">
          <div class="flex h-full w-full items-center justify-center font-medium text-indigo-600 dark:text-indigo-300">
            {{ firstLetter }}
          </div>
        </div>
        <div>
          <h3 class="font-medium text-gray-900 dark:text-white">{{ chat.title }}</h3>
          <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1">
            <p class="text-xs text-gray-500 dark:text-gray-400">ID: {{ chat.id }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{ chat.username ?? 'no username' }}</p>
            <span v-if="chat.isVerified" class="text-xs text-blue-500 dark:text-blue-400 flex items-center">
              <Verified class="h-3.5 w-3.5 mr-1" />
              Verified
            </span>
            <span v-if="chat.isRestricted" class="text-xs text-red-500 dark:text-red-400 flex items-center">
              <Lock class="h-3.5 w-3.5 mr-1" />
              Restricted
            </span>
          </div>
        </div>
      </div>
      <div class="flex flex-col items-end gap-1">
        <div class="rounded-full bg-indigo-100 px-2.5 py-0.5 text-xs font-medium text-indigo-800 dark:bg-neutral-600/30 dark:text-indigo-300 flex items-center gap-1">
          <MessageSquare v-if="chatType === 'Chat'" class="h-3.5 w-3.5" />
          <Users v-if="chatType === 'Supergroup'" class="h-3.5 w-3.5" />
          <Broadcast v-if="chatType === 'Channel'" class="h-3.5 w-3.5" />
          {{ chatType }}
        </div>
        <span v-if="chat.participantsCount" class="text-xs text-gray-500 dark:text-gray-400">
          {{ chat.participantsCount }} members
        </span>
      </div>
    </div>
  </div>
</template>