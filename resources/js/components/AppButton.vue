<template>
    <button class="bg-indigo-500 text-white px-4 py-3 leading-none rounded-lg font-medium"
            :disabled="disabled"
            :class="{'opacity-50':disabled}">
        <span v-if="loading">Just a sec...</span><span v-else>{{title}}</span>
    </button>
</template>

<script>
    export default {
        name: "AppButton",
        props:{
            title:{
                required: true,
                type: String
            },
            disabled:{
                required: false,
                type: Boolean
            },
            loading:{
                required: false,
                type: Boolean
            }
        }
    }
</script>

<style scoped>

</style>
