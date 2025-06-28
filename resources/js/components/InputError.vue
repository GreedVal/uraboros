<script setup lang="ts">
import { ref, watch, onUnmounted } from 'vue'

const props = defineProps<{
  message?: string
}>()

const showMessage = ref(false)
let timeoutId: ReturnType<typeof setTimeout> | null = null

// Очистка таймера при размонтировании компонента
onUnmounted(() => {
  if (timeoutId) clearTimeout(timeoutId)
})

watch(() => props.message, (newVal) => {
  showMessage.value = Boolean(newVal)
  
  // Очищаем предыдущий таймер
  if (timeoutId) {
    clearTimeout(timeoutId)
    timeoutId = null
  }
  
  // Устанавливаем новый таймер, если есть сообщение
  if (newVal) {
    timeoutId = setTimeout(() => {
      showMessage.value = false
    }, 5000)
  }
}, { immediate: true })
</script>

<template>
  <transition name="fade">
    <div v-if="showMessage" class="text-sm text-red-600 dark:text-red-500">
      {{ message }}
    </div>
  </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>