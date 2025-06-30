<script setup lang="ts">
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import Select from '@/components/ui/select/Select.vue'
import InfoSearchForm from '@/components/telegram/InfoSearchForm.vue'
import InputError from '@/components/InputError.vue' // Убедитесь, что импортировали компонент ошибок

const page = usePage()
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Web', href: '/web' }
]

type SearchType = 'info'

const isValidSearchType = (value: unknown): value is SearchType => {
  return ['info'].includes(value as SearchType)
}

const getInitialSearchType = (): SearchType => {
  const storedValue = localStorage.getItem('type')
  return isValidSearchType(storedValue) ? storedValue : 'info'
}

const searchType = ref<SearchType>(getInitialSearchType())

const handleSearchTypeChange = (value: SearchType) => {
  searchType.value = value
  localStorage.setItem('type', value)
}

interface SearchOption {
  value: SearchType
  label: string
}

const searchOptions: SearchOption[] = [
  { value: 'info', label: 'Web site info' },
]
</script>

<template>
  <Head title="Telegram" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="mx-4 mt-4">
      <Select
        v-model="searchType"
        @update:modelValue="handleSearchTypeChange"
        :options="searchOptions"
        placeholder="Select search type"
        variant="outline"
        size="default"
        class="mb-6 w-1/3"
      />
    </div>

    <div class="space-y-8">
      <div class="max-w-md mx-auto">
          <InputError v-if="page.props.errors.error" :message="page.props.errors.error" class="mt-2" />
      </div>
      <InfoSearchForm
        v-if="searchType === 'info'"
        title=""
        action="/"
        label=""
      />
    </div>
  </AppLayout>
</template>