<template>
    <span class="inline-block text-xs font-medium text-gray-800 text-center bg-gray-200 rounded-lg py-1 px-2">
        Usage: {{usageFormatted}} / {{storageFormatted}} ({{percentageUsed}}%)
    </span>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    import fileSize from 'filesize'

    export default {
        name: "AppUsage",
        computed: {
            ...mapGetters({
                usage: 'usage/usage',
                user: 'auth/user'
            }),
            usageFormatted () {
                return fileSize(this.usage)
            },
            storageFormatted () {
                return fileSize(this.user.plan.storage)
            },
            percentageUsed () {
                return ((this.usage / this.user.plan.storage) * 100).toFixed(2)
            }
        },

        methods: {
            ...mapActions({
                getUsage:'usage/getUsage'
            })
        },
        mounted() {
            this.getUsage()
        }
    }
</script>

<style scoped>

</style>
