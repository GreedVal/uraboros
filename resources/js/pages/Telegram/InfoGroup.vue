<script setup lang="ts">
import { type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Telegram Groups',
        href: '/telegram',
    },
    {
        title: 'Group Info',
        href: '#',
    },
];

const props = defineProps<{
    groups?: any[]
}>();

const group = props.groups?.[0] || null;

const formatRightName = (right: string): string => {
    if (typeof right !== 'string') return String(right);

    const names: Record<string, string> = {
        '_': 'chatBannedRights',
        'view_messages': 'View Messages',
        'send_messages': 'Send Messages',
        'send_media': 'Send Media',
        'send_stickers': 'Send Stickers',
        'send_gifs': 'Send GIFs',
        'send_games': 'Send Games',
        'send_inline': 'Inline Mode',
        'embed_links': 'Embed Links',
        'send_polls': 'Send Polls',
        'change_info': 'Change Info',
        'invite_users': 'Invite Users',
        'pin_messages': 'Pin Messages',
        'manage_topics': 'Manage Topics',
        'send_photos': 'Send Photos',
        'send_videos': 'Send Videos',
        'send_roundvideos': 'Send Video Messages',
        'send_audios': 'Send Audio',
        'send_voices': 'Send Voice Messages',
        'send_docs': 'Send Documents',
        'send_plain': 'Plain Messages',
    };
    return names[right] || right.split('_').map(word =>
        word.charAt(0).toUpperCase() + word.slice(1)
    ).join(' ');
};
</script>

<template>
    <Head title="Group Info" />

    <AppLayout :breadcrumbs="breadcrumbItems">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <!-- Скелетон загрузки -->
            <div v-if="!group" class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div v-for="i in 3" :key="i"
                     class="relative aspect-video overflow-hidden rounded-xl border border-gray-200 dark:border-neutral-700">
                    <div class="h-full w-full animate-pulse bg-gray-200 dark:bg-neutral-900"></div>
                </div>
                <div class="relative min-h-[100vh] flex-1 rounded-xl border border-gray-200 md:min-h-min dark:border-neutral-700">
                    <div class="h-full w-full animate-pulse bg-gray-200 dark:bg-neutral-900"></div>
                </div>
            </div>

            <!-- Основной контент -->
            <div v-else class="flex flex-col gap-4">
                <!-- Шапка группы -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
                    <div class="flex items-center">
                        <div class="mr-4 h-16 w-16 overflow-hidden rounded-full border-2 border-gray-300 dark:border-gray-600">
                            <img v-if="group.photo" :src="`https://telegram.org/img/t_logo.png`" alt="Group photo" class="h-full w-full object-cover">
                            <div v-else class="flex h-full w-full items-center justify-center bg-gray-100 text-2xl font-bold text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                {{ group.title?.charAt(0) || 'T' }}
                            </div>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">{{ group.title || 'No Title' }}</h1>
                            <p class="text-gray-600 dark:text-gray-400" v-if="group.username">@{{ group.username }}</p>
                            <p class="text-gray-600 dark:text-gray-400" v-if="group.id">{{ group.id }}</p>
                        </div>
                    </div>
                </div>

                <!-- Основная информация -->
                <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                    <!-- Статистика -->
                    <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
                        <h2 class="mb-3 text-lg font-semibold text-gray-800 dark:text-gray-200">Group Stats</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between border-b border-gray-100 pb-2 dark:border-gray-700">
                                <span class="text-gray-600 dark:text-gray-400">Members</span>
                                <span class="font-medium text-gray-800 dark:text-white">{{ group.participantsCount?.toLocaleString() || 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2 dark:border-gray-700">
                                <span class="text-gray-600 dark:text-gray-400">Online</span>
                                <span class="font-medium text-gray-800 dark:text-white">{{ group.onlineCount?.toLocaleString() || 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2 dark:border-gray-700">
                                <span class="text-gray-600 dark:text-gray-400">Type</span>
                                <span class="font-medium text-gray-800 dark:text-white">{{ group.isMegagroup ? 'Supergroup' : 'Group' }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2 dark:border-gray-700">
                                <span class="text-gray-600 dark:text-gray-400">linked chat id</span>
                                <span class="font-medium text-gray-800 dark:text-white">{{ group.linkedChatId }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Created</span>
                                <span class="font-medium text-gray-800 dark:text-white">
                                    {{ group.date ? new Date(group.date * 1000).toLocaleDateString() : 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Настройки -->
                    <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
                        <h2 class="mb-3 text-lg font-semibold text-gray-800 dark:text-gray-200">Settings</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between border-b border-gray-100 pb-2 dark:border-gray-700">
                                <span class="text-gray-600 dark:text-gray-400">Join to Send</span>
                                <span :class="{'text-green-600 dark:text-green-400': !group.joinToSend, 'text-red-600 dark:text-red-400': group.joinToSend}">
                                    {{ group.joinToSend ? 'Required' : 'Not required' }}
                                </span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2 dark:border-gray-700">
                                <span class="text-gray-600 dark:text-gray-400">Linked Chat</span>
                                <span :class="{'text-green-600 dark:text-green-400': group.hasLink, 'text-gray-600 dark:text-gray-400': !group.hasLink}">
                                    {{ group.hasLink ? 'Yes' : 'No' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Реакции -->
                    <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
                        <h2 class="mb-3 text-lg font-semibold text-gray-800 dark:text-gray-200">Available Reactions</h2>
                        <div class="flex flex-wrap gap-2">
                            <div v-for="(reaction, index) in group.availableReactions" :key="index"
                                 class="rounded-full bg-gray-100 p-2 text-2xl dark:bg-gray-700">
                                {{ reaction.emoticon }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Описание и ограничения -->
                <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                    <!-- Описание -->
                    <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
                        <h2 class="mb-3 text-lg font-semibold text-gray-800 dark:text-gray-200">Description</h2>
                        <div class="whitespace-pre-line rounded bg-gray-100 p-3 text-gray-700 dark:bg-neutral-700/50 dark:text-gray-300">
                            {{ group.about || 'No description provided' }}
                        </div>
                    </div>

                    <!-- Ограничения -->
                    <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
                        <h2 class="mb-3 text-lg font-semibold text-gray-800 dark:text-gray-200">Permissions</h2>
                        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                            <template v-if="group.defaultBannedRights && Object.keys(group.defaultBannedRights).length > 0">
                                <div v-for="(value, right) in group.defaultBannedRights"
                                     :key="right"
                                     class="flex items-center justify-between rounded bg-gray-100 p-2 dark:bg-neutral-700/50">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ formatRightName(right) }}</span>
                                    <span :class="{
                                        'text-green-600 dark:text-green-400': !value,
                                        'text-red-600 dark:text-red-400': value
                                    }" class="text-sm font-medium">
                                        {{ value ? 'Banned' : 'Allowed' }}
                                    </span>
                                </div>
                            </template>
                            <div v-else class="text-sm text-gray-600 dark:text-gray-400">
                                No permissions data available
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
