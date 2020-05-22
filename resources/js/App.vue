<template>
    <div id="app">
        <header-block v-if="this.isAuthenticated"></header-block>
        <router-view></router-view>
        <footer-block></footer-block>
    </div>
</template>

<script>
    import Header from "./components/layouts/Header";
    import Footer from "./components/layouts/Footer";
    import {mapGetters, mapState} from 'vuex';

    export default {
        components: {
            HeaderBlock: Header,
            FooterBlock: Footer
        },
        name: "app",
        computed: {
            ...mapGetters("user", {
                isAuthenticated: 'isAuthenticated'
            }),
        },
    }
</script>

<style>
    html, body{ /* *, html, body*/
        margin: 0;
        padding: 0;
        outline: none;
        background-color: #BCE7EF;/*#B0E0E6;*/
    }
</style>

