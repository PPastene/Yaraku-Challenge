<template>
    <b-container>
        <b-alert
            v-if="$page.props.flash.success && show"
            class="position-fixed fixed-top m-0 rounded-0"
            style="z-index: 2000;"
            variant="success"
            show
            dismissible
            @dismissed="show = false"
        >
            {{ $page.props.flash.success }}
        </b-alert>
        <b-alert
            v-if="($page.props.flash.error || Object.keys($page.props.errors).length > 0) && show"
            class="position-fixed fixed-top m-0 rounded-0"
            style="z-index: 2000;"
            variant="danger"
            show
            dismissible
            @dismissed="show = false"
        >
            <span v-if="$page.props.flash.error">{{ $page.props.flash.error }}</span>
            <span v-else>There's an error during your request</span>
        </b-alert>
        <b-alert
            v-if="$page.props.flash.success && show && ($page.props.flash.success.export)"
            class="position-fixed fixed-top m-0 rounded-0"
            style="z-index: 2000;"
            variant="success"
            show
            dismissible
            @dismissed="show = false"
        >
            You can download the file <a :href="$page.props.flash.success.export">here</a>
        </b-alert>
    </b-container>
</template>
<script>
export default {
    data() {
        return {
            show: true,
        }
    },
    watch:
    {
        '$page.props.flash': {
            handler() {
                this.show = true
                },
            deep: true,
        },
    }
}
</script>
