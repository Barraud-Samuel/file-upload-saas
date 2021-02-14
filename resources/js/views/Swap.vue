<template>
    <div>
        <form action="" @submit.prevent="swap">
            <div class="mb-6">
                <div class="mb-2 flex items-center" v-for="plan in plans" :key="plan.slug">
                    <input type="radio" name="plan" :id="`plan_${plan.slug}`" class="mr-3" v-model="form.plan" :value="plan.slug" v-if="availablePlans.find(p => p.slug === plan.slug)">
                    <label :for="`plan_${plan.slug}`" class="flex-grow">
                        <app-plan :plan="plan" class="flex-grow cursor-pointer" />
                    </label>
                </div>
            </div>
            <app-button v-if="availablePlans.length" title="Swap" :disabled="loading || !form.plan" type="submit" :loading="loading" />
            <p v-else class="text-gray-800 text-sm">There are no available plans for you to swap to right now, because you are using too much storage.</p>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'
    import AppPlan from "../components/AppPlan";
    import AppButton from "../components/AppButton";
    import {mapGetters,mapActions} from 'vuex'

    export default {
        name: "Swap",
        components: {
            AppPlan,
            AppButton
        },
        data() {
            return {
                loading: false,
                plans:[],
                planAvailability: [],
                form:{
                    plan: null
                }
            }
        },

        computed: {
            ...mapGetters({
                user: 'auth/user',
            }),
            availablePlans () {
                return this.plans.filter(p => p.slug !== this.user.plan.slug && this.planAvailability[p.slug])
            },

            chosenPlan () {
                return this.plans.find(p => p.slug === this.form.plan)
            }
        },

        async mounted () {
            let plans = await axios.get('api/plans')
            this.plans = plans.data.data

            let planAvailability = await axios.get('api/user/plan_availability')
            this.planAvailability = planAvailability.data.data
        },

        methods:{
            ...mapActions({
                me:'auth/me',
                snack: 'snack/snack'
            }),
            async swap(){
                this.loading = true
                await axios.patch('api/subscriptions', this.form)
                await this.me()

                this.loading = false

                this.snack(`You have swapped to the ${this.chosenPlan.name} plan`)
                this.$router.replace({name:'account'})
            }
        }
    }
</script>

<style scoped>

</style>
