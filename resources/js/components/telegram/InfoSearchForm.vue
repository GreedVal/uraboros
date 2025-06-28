<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useForm } from '@inertiajs/vue3'
import { LoaderCircle } from 'lucide-vue-next';

interface Props {
  action: string;
  title?: string;
  label?: string;
  placeholder?: string;
}

const props = defineProps<Props>();

const form = useForm({
  query: '',
})

const submit = () => {
  const url = new URL(props.action, window.location.origin)
  url.searchParams.append('query', form.query)
  form.get(url.toString())
}
</script>

<template>
  <div class="max-w-md mx-auto">
    <h1 v-if="title" class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">{{ title }}</h1>

    <form @submit.prevent="submit" class="space-y-4">
      <div class="grid gap-1">
        <Label v-if="label" for="query" class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ label }}</Label>
        <Input
          id="query"
          type="text"
          v-model="form.query"
          :placeholder="placeholder || 'Enter username group'"
          required
          class="bg-white border-gray-300"
        />
      </div>

      <Button type="submit" class="w-full mt-2">
        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
        Search
      </Button>
    </form>
  </div>
</template>