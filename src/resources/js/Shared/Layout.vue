<template>
    <v-app>
        <flash-messages />
        <slot/>
    </v-app>
</template>
<script>
import FlashMessages from '@/Shared/FlashMessages'
export default {
    components: {
        FlashMessages
    }
}
</script>
