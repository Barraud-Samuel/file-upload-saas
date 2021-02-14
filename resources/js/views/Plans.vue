<template>
    <div>
        <router-link :to="{name:'checkout',query:{plan:plan.slug}}" href="" v-for="plan in buyablePlans" :key="plan.slug">
            <app-plan :plan="plan" class="mb-2" />
        </router-link>
    </div>
</template>

<script>
    import axios from 'axios'
    import AppPlan from "../components/AppPlan";
    export default {
        name: "Plans",
        components: {
            AppPlan
        },
        data(){
            return{
                plans:[]
            }
        },
        computed: {
            buyablePlans () {
                return this.plans.filter(p=>!p.free)
            }
        },
        async mounted() {
            let response = await axios.get('api/plans')
            this.plans = response.data.data
        }
    }
</script>

<style scoped>

</style>
