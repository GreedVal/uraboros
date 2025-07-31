<script setup lang="ts">
import { type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Web',
        href: '/web',
    },
    {
        title: 'Info site',
        href: '#',
    },
];

const props = defineProps<{
  data: {
    ip: {
      host: string
      ip: string
      success: boolean
    }
    dns: {
      type: string
      host: string
      ip: string | null
      target: string | null
      ttl: number
      priority: number | null
    }[]
    ssl: {
      success: boolean
      subject: Record<string, string>
      issuer: Record<string, string>
      valid_from: string
      valid_to: string
      error: string | null
    }
    headers: Record<string, string>
    redirects: {
      effectiveUrl: string
      redirectCount: number
      success: boolean
      error: string | null
    }
    robots: {
      exists: boolean
      content: string
    }
    technologies: any
  }
}>()
</script>

<template>
<Head title="Group Info" />
    <AppLayout :breadcrumbs="breadcrumbItems">
            
            
    </AppLayout>
</template>
