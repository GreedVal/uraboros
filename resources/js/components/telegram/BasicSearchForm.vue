<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useForm } from '@inertiajs/vue3';
import { Search, LoaderCircle } from 'lucide-vue-next';

interface Props {
  action: string;
  title?: string;
  label?: string;
  placeholder?: string;
}

const {
  action,
  title = 'TELEGRAM SEARCH',
  label = 'username',
  placeholder = 'username'
} = defineProps<Props>();

const form = useForm({
  name: '',
  query: ''
});

const submit = () => {
  const url = new URL(action, window.location.origin);
  url.searchParams.append('name', form.name);
  if (form.word) {
    url.searchParams.append('query', form.word);
  }
  form.get(url.toString());
};
</script>

<template>
  <div class="max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">{{ title }}</h1>

    <form @submit.prevent="submit" class="space-y-4">
      <div class="grid gap-1">
        <Label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ label }}</Label>
        <Input
          id="name"
          type="text"
          v-model="form.name"
          required
          placeholder="Username group"
          class="bg-white border-gray-300"
        />
        <Input
          id="query"
          type="text"
          v-model="form.query"
          :placeholder="placeholder"
          class="bg-white border-gray-300"
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
