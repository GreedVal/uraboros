<script setup lang="ts">
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import BasicSearchForm from '@/components/telegram/BasicSearchForm.vue'
import ParticipantsSearchForm from '@/components/telegram/ParticipantsSearchForm.vue'
import Select from '@/components/ui/select/Select.vue'
import InfoSearchForm from '@/components/telegram/InfoSearchForm.vue'
import InputError from '@/components/InputError.vue' // Убедитесь, что импортировали компонент ошибок

const page = usePage()
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Telegram', href: '/telegram' }
]

type SearchType = 'word' | 'user' | 'participants' | 'info'

const isValidSearchType = (value: unknown): value is SearchType => {
  return ['word', 'user', 'participants', 'info'].includes(value as SearchType)
}

const getInitialSearchType = (): SearchType => {
  const storedValue = localStorage.getItem('telegramSearchType')
  return isValidSearchType(storedValue) ? storedValue : 'word'
}

const searchType = ref<SearchType>(getInitialSearchType())

const handleSearchTypeChange = (value: SearchType) => {
  searchType.value = value
  localStorage.setItem('telegramSearchType', value)
}

interface SearchOption {
  value: SearchType
  label: string
}

const searchOptions: SearchOption[] = [
  { value: 'word', label: 'Messages by word search' },
  { value: 'user', label: 'Messages by user search' },
  { value: 'participants', label: 'Participants search' },
  { value: 'info', label: 'Info group search' }
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
      
      <BasicSearchForm
        v-if="searchType === 'word'"
        title=""
        action="/telegram/word-messages"
        label=""
        placeholder="word"
      />

      <BasicSearchForm
        v-if="searchType === 'user'"
        title=""
        action="/telegram/user-messages"
        label=""
        placeholder="username"
      />

      <ParticipantsSearchForm
        v-else-if="searchType === 'participants'"
        title=""
        action="/telegram/participants-group"
        label=""
      />
      <InfoSearchForm
        v-else-if="searchType === 'info'"
        title=""
        action="/telegram/info-group"
        label=""
      />
    </div>
  </AppLayout>
</template>