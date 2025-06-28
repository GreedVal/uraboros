<script setup lang="ts">
import type { User, Participant } from '@/types/telegram';

const props = defineProps<{
  participants: Participant[];
}>();


const getUserInitials = (user?: User): string => {
  if (!user) return '?';
  const firstName = user.firstName || '';
  const lastName = user.lastName || '';
  return `${firstName.charAt(0)}${lastName.charAt(0)}` || '?';
};

const formatStatus = (status?: { type?: string }): string => {
  if (!status?.type) return 'Unknown';
  
  const statusStr = status.type.toString();
  
  if (statusStr.includes('.')) {
    return statusStr.split('.').pop()?.replace('UserStatus', '') || 'Unknown';
  }
  
  return statusStr.replace('UserStatus', '');
};

const formatDate = (date: string): string => {
  if (!date) return 'Unknown';
  
  const dateObj = typeof date === 'number' 
    ? new Date(date * 1000) 
    : new Date(date);
    
  return dateObj.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  });
};
</script>

<template>
  <div class="rounded-xl p-6">
    <div 
      v-for="participant in participants" 
      :key="participant.userId"
      class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-neutral-600 dark:bg-neutral-900 mb-3 last:mb-0"
    >
      <!-- Participant Header -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
        <div class="flex items-center gap-3">
          <div class="relative h-10 w-10 shrink-0 overflow-hidden rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-neutral-600 dark:to-neutral-900">
            <div class="flex h-full w-full items-center justify-center font-medium text-indigo-600 dark:text-indigo-300 text-sm">
              {{ getUserInitials(participant.user) }}
            </div>
          </div>
          <div>
            <h3 class="font-medium text-gray-900 dark:text-white text-sm">
              {{ participant.user?.firstName || 'Unknown' }}
              {{ participant.user?.lastName || '' }}
            </h3>
            <div class="flex items-center gap-1.5 mt-0.5">
              <span class="text-xs text-gray-500 dark:text-gray-400">
                ID: {{ participant.userId }}
              </span>
              <span 
                v-if="participant.user?.username" 
                class="text-xs text-gray-500 dark:text-gray-400"
              >
                @{{ participant.user.username }}
              </span>
            </div>
          </div>
        </div>
        <div class="flex flex-wrap items-center gap-1.5">
          <span class="rounded-full bg-indigo-100 px-2.5 py-0.5 text-xs font-medium text-indigo-800 dark:bg-neutral-600/30 dark:text-indigo-300">
            {{ participant.type.replace('ChannelParticipant', '') }}
          </span>
        </div>
      </div>

      <!-- Participant Details -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
        <!-- Status Block -->
        <div class="rounded-lg bg-gray-50 p-2 dark:bg-neutral-700/50">
          <div class="text-xs font-medium text-gray-500 dark:text-gray-400">Status</div>
          <div class="font-medium text-gray-900 dark:text-white text-sm">
            {{ formatStatus(participant.user?.status) }}
          </div>
        </div>

        <!-- Flags Block -->
        <div class="rounded-lg bg-gray-50 p-2 dark:bg-neutral-700/50">
          <div class="text-xs font-medium text-gray-500 dark:text-gray-400">Flags</div>
          <div class="flex flex-wrap gap-1 mt-0.5">
            <span 
              v-if="participant.user?.bot" 
              class="rounded-full bg-red-100 px-1.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900/30 dark:text-red-300"
            >
              Bot
            </span>
            <span 
              v-if="participant.user?.verified" 
              class="rounded-full bg-blue-100 px-1.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900/30 dark:text-blue-300"
            >
              Verified
            </span>
            <span 
              v-if="participant.user?.premium" 
              class="rounded-full bg-yellow-100 px-1.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300"
            >
              Premium
            </span>
            <span 
              v-if="participant.user?.scam" 
              class="rounded-full bg-purple-100 px-1.5 py-0.5 text-xs font-medium text-purple-800 dark:bg-purple-900/30 dark:text-purple-300"
            >
              Scam
            </span>
          </div>
        </div>

        <!-- Date Block -->
        <div class="rounded-lg bg-gray-50 p-2 dark:bg-neutral-700/50">
          <div class="text-xs font-medium text-gray-500 dark:text-gray-400">Joined</div>
          <div class="font-medium text-gray-900 dark:text-white text-sm">
            {{ formatDate(participant.date) }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>