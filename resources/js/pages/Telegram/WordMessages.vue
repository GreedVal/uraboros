<script setup lang="ts">
import { type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { type IMessagesResponse } from '@/types/messages';
import MainGroup from '@/components/telegram/messages/MainGroup.vue';
import Pagination from '@/components/telegram/Pagination.vue';
import RepostGroup from '@/components/telegram/messages/RepostGroup.vue';
import Message from '@/components/telegram/messages/Message.vue';

const props = defineProps<{
  data: IMessagesResponse;
  queryParams: Record<string, any>;
  totalPages: number;
}>();

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Telegram',
        href: '/telegram',
    },
    {
        title: `messages (${props.data.count})`,
        href: '#',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <div class="mx-4 mt-4">
            <div v-if="data.count > 0" class="space-y-4">
                <MainGroup :chat="data.chat[0]" />

                <Pagination
                  :query-params="queryParams"
                  route-name="word-messages"
                  :totalPages= "totalPages"
                />

                    <RepostGroup :chats="data.chat" />

                    <Message
                        :messages="data.messages"
                        :chat="data.chat"
                />
                <Pagination
                  :query-params="queryParams"
                  route-name="word-messages"
                  :totalPages= "totalPages"
                />
            </div>
        </div>
    </AppLayout>
</template>
