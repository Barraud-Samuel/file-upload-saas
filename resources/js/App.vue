<template>
    <div class="w-full md:w-8/12 lg:w6/12 mx-auto px-6 mt-6 md:mt20">
        <app-snack />
        <app-nav />
        <router-view/>
    </div>
</template>

<script>
    import AppNav from "./components/AppNav";
    import AppSnack from "./components/AppSnack";
    export default {
        components: {
            AppNav,
            AppSnack
        }
    }
</script>
