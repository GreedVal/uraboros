<script setup lang="ts">
import { computed, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const props = defineProps<{
  queryParams?: Record<string, any>;
  routeName: string;
  totalPages?: number;
}>();

const currentPage = computed(() => props.queryParams?.page || 1);
const totalPages = computed(() => props?.totalPages || 1);
const isLoading = ref(false);

const navigate = (page: number) => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
  isLoading.value = true;

  const params = {
    ...props.queryParams,
    page: page.toString()
  };

  const searchParams = new URLSearchParams();
  for (const [key, value] of Object.entries(params)) {
    if (value !== undefined && value !== null) {
      searchParams.append(key, value.toString());
    }
  }

  router.get(props.routeName + `?${searchParams.toString()}`, {}, {
    preserveState: true,
    preserveScroll: false,
    replace: true,
    onFinish: () => {
      isLoading.value = false;
    }
  });
};
</script>

<template>
  <div v-if="totalPages > 1" class="mt-8 flex items-center justify-center gap-4">
    <button
      @click="navigate(currentPage - 1)"
      :disabled="currentPage === 1"
      class="px-4 py-2 bg-neutral-700 rounded-lg text-white hover:bg-neutral-600 transition-colors flex items-center gap-2 disabled:bg-neutral-800 disabled:text-neutral-500 disabled:cursor-not-allowed"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </button>

    <div class="text-neutral-300 flex items-center">
      Page {{ currentPage }} / {{ totalPages }}
      <LoaderCircle v-if="isLoading" class="h-4 w-4 mr-2 animate-spin" />
    </div>

    <button
      @click="navigate(currentPage + 1)"
      :disabled="currentPage === totalPages"
      class="px-4 py-2 bg-neutral-700 rounded-lg text-white hover:bg-neutral-600 transition-colors flex items-center gap-2 disabled:bg-neutral-800 disabled:text-neutral-500 disabled:cursor-not-allowed"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
    </button>
  </div>
</template>
