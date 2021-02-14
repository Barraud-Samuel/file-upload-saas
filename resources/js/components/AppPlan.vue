<template>
    <div class="border-2 border-gray-200 rounded-lg px-6 py-4 flex items-center justify-between">
        <div class="flex items-center">
            <h2 class="font-bold text-lg mr-4 text-indigo-500">{{plan.name}}</h2>
            <span class="text-sm text-gray-800">{{storageFormatted}}</span>
        </div>
        <span class="font-medium">€{{parseInt(plan.price,10)/100}} / month</span>
    </div>
</template>

<script>
    import fileSize from 'filesize'
    export default {
        name: "AppPlan",
        props:{
            plan:{
                required:true,
                type:Object
            }
        },
        computed: {
            storageFormatted () {
                return fileSize(this.plan.storage)
            }
        }
    }
</script>

<style scoped>

</style>
