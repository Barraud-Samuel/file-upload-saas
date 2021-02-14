<template>
    <header class="flex flex-crap md:flex-no-wrap items-center justify-between mb-6 -mx-3 -mt-3">
        <ul class="flex items-center">
            <li>
                <router-link :to="{name:'home'}" class="text-sm inline-block p-3 text-gray-800">home</router-link>
            </li>
            <li>
                <router-link :to="{name:'uploads'}" class="text-sm inline-block p-3 text-gray-800">You files</router-link>
            </li>
        </ul>
        <div class="flex justify-center order-last w-full md:w-auto md:order-none">
            <app-usage v-if="authenticated" />
        </div>
        <ul class="flex items-center">
            <template v-if="!authenticated">
                <li>
                    <router-link :to="{name:'login'}" class="text-sm inline-block p-3 text-gray-800">Sign in</router-link>
                </li>
                <li>
                    <router-link :to="{name:'register'}" class="text-sm inline-block p-3 text-gray-800">Create an account</router-link>
                </li>
            </template>
            <template v-else>
                <li>
                    <router-link :to="{name:'account'}" class="text-sm inline-block p-3 text-gray-800">Account</router-link>
                </li>
                <li>
                    <a href="#" class="text-sm inline-block p-3 text-gray-800" @click.prevent="logout">Log out</a>
                </li>
            </template>
            <li v-if="!authenticated || !user.subscribed">
                <router-link :to="{name:'plans'}" class="text-sm inline-block font-semibold p-3 text-indigo-500">Upgrade🌠</router-link>
            </li>
        </ul>
    </header>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    import AppUsage from "./AppUsage"

    export default {
        name: "AppNav",
        components: {
            AppUsage
        },
        computed: {
            ...mapGetters({
                authenticated: 'auth/authenticated',
                user: 'auth/user'
            }),
        },
        methods: {
            ...mapActions({
               logoutAction: 'auth/logout'
            }),
            async logout () {
                await this.logoutAction()

                this.$router.replace({name:'home'})
            }
        }
    }
</script>

<style scoped>

</style>
