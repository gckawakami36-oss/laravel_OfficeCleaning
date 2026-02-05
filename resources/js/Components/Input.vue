defineEmits(['update:modelValue']);

<input @input="$emit('update:modelValue', $event.target.value)"/>