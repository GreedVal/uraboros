<script setup lang="ts">
import { computed } from 'vue';
import { type IChat } from '@/types/messages';
import { Verified } from 'lucide-vue-next';

const props = defineProps<{
  chats: IChat[];
}>();

const sourceChats = computed(() => props.chats.slice(1));
const getFirstLetter = (title: string) => title.charAt(0).toUpperCase();
</script>

<template>
  <div v-if="sourceChats.length > 0" class="mb-6">
    <h4 class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">Repost sources:</h4>
    <div class="space-y-3">
      <div 
        v-for="sourceChat in sourceChats" 
        :key="sourceChat.id"
        class="rounded-xl border border-gray-200 bg-white p-3 shadow-sm dark:border-neutral-600 dark:bg-neutral-900 transition-colors hover:border-gray-300 dark:hover:border-neutral-500"
      >
        <div class="flex items-center gap-2">
          <div class="relative h-8 w-8 shrink-0 overflow-hidden rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-neutral-600 dark:to-neutral-900">
            <div class="flex h-full w-full items-center justify-center text-xs font-medium text-indigo-600 dark:text-indigo-300">
              {{ getFirstLetter(sourceChat.title) }}
            </div>
          </div>
          <div class="flex-1 min-w-0">
            <p class="font-medium text-gray-900 dark:text-white text-sm truncate">{{ sourceChat.title }}</p>
            <div class="flex flex-wrap gap-x-3 gap-y-0 text-xs text-gray-500 dark:text-gray-400">
              <span>ID: {{ sourceChat.id }}</span>
              <span v-if="sourceChat.username">{{ sourceChat.username }}</span>
              <span v-if="sourceChat.isVerified" class="text-blue-500 dark:text-blue-400 flex items-center">
                <Verified class="h-3 w-3 mr-0.5" />
                Verified
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>