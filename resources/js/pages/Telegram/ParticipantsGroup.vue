<script setup lang="ts">
import { computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import Pagination from '@/components/telegram/Pagination.vue';
import ParticipantCards from '@/components/telegram/CardParticipant.vue';
import type { BreadcrumbItem, Participant } from '@/types/telegram';


const props = defineProps<{
  count: number;
  participants: Participant[];
  queryParams: Record<string, any>;
  totalPages: number;
}>();

const breadcrumbItems = computed<BreadcrumbItem[]>(() => [
  {
    title: 'Telegram',
    href: '/telegram',
  },
  {
    title: `Participants (${props.count})`,
    href: '#',
  },
]);
</script>

<template>
  <Head title="Telegram Group Participants" />

  <AppLayout :breadcrumbs="breadcrumbItems">
    <div class="space-y-6">
      <div v-if="count > 0" class="space-y-4">
        <Pagination
          :query-params="queryParams"
          route-name="participants-group"
          :totalPages= "totalPages"
        />
        <ParticipantCards :participants="participants" />
        <Pagination
          :query-params="queryParams"
          route-name="participants-group"
          :totalPages= "totalPages"
        />
      </div>

      <div v-else class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-8 text-center dark:border-gray-600 dark:bg-gray-800">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No participants found</h3>
        <p class="mt-1 text-gray-500 dark:text-gray-400">Try checking the group parameters</p>
      </div>
    </div>
  </AppLayout>
</template>
