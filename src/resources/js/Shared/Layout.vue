<template>
    <div>
        <flash-messages />
        <slot/>
    </div>
</template>
<script>
import FlashMessages from '@/Shared/FlashMessages'
export default {
    components: {
        FlashMessages
    }
}
</script>
