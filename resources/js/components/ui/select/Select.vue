<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { cn } from '@/lib/utils'
import { Primitive, type PrimitiveProps } from 'reka-ui'
import { selectVariants } from '@/lib/select-variants'

interface SelectVariantProps {
  variant?: 'default' | 'destructive' | 'outline' | 'ghost'
  size?: 'default' | 'sm' | 'lg'
}

interface Props extends PrimitiveProps {
  variant?: SelectVariantProps['variant']
  size?: SelectVariantProps['size']
  modelValue?: string | number
  options: Array<{ value: string | number; label: string }>
  placeholder?: string
  disabled?: boolean
  class?: HTMLAttributes['class']
}

const props = withDefaults(defineProps<Props>(), {
  as: 'select',
  modelValue: '',
  placeholder: 'Select...',
  disabled: false,
  variant: 'default',
  size: 'default'
})

const emit = defineEmits(['update:modelValue'])

const handleChange = (event: Event) => {
  const target = event.target as HTMLSelectElement
  emit('update:modelValue', target.value)
}
</script>

<template>
  <div class="relative">
    <Primitive
      :as="as"
      :as-child="asChild"
      :class="cn(selectVariants({ variant, size }), props.class)"
      :value="modelValue"
      :disabled="disabled"
      @change="handleChange"
    >
      <option value="" disabled hidden>{{ placeholder }}</option>
      <option
        v-for="option in options"
        :key="option.value"
        :value="option.value"
        class="bg-background text-foreground"
      >
        {{ option.label }}
      </option>
    </Primitive>
  </div>
</template>
