<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Search, LoaderCircle } from 'lucide-vue-next';
import Select from '@/components/ui/select/Select.vue';

interface Props {
  action: string;
  title?: string;
  label?: string;
  showFilter?: boolean;
}

const {
  action,
  title = '',
  showFilter = true
} = defineProps<Props>();

const filters = [
  { value: 'channelParticipantsRecent', label: 'All participants' },
  { value: 'channelParticipantsAdmins', label: 'Admins' },
  { value: 'channelParticipantsBots', label: 'Bots' },
];

const form = useForm({
  name: '',
  filter: 'channelParticipantsRecent'
});

const submit = () => {
  const url = new URL(action, window.location.origin);
  url.searchParams.append('name', form.name);
  url.searchParams.append('filter', form.filter);
  form.get(url.toString());
};
</script>

<template>
  <div class="max-w-md mx-auto">
    <h1 v-if="title" class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">{{ title }}</h1>

    <form @submit.prevent="submit" class="space-y-4">
      <div class="grid gap-1">
        <Input
          id="chatUsername"
          type="text"
          v-model="form.name"
          required
          placeholder="Username group"
          class="bg-white border-gray-300"
        />
      </div>

      <div v-if="showFilter" class="grid gap-1">
        <Select
          v-model="form.filter"
          name="filter"
          :options="filters"
          required
          placeholder="Type participants"
          variant="outline"
          size="default"
        />
      </div>

      <Button type="submit" class="w-full mt-2" :disabled="form.processing">
        <LoaderCircle v-if="form.processing" class="h-4 w-4 mr-2 animate-spin" />
        <Search v-else class="h-4 w-4 mr-2" />
        Search
      </Button>
    </form>
  </div>
</template>
