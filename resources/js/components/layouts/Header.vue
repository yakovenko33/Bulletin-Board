<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
<!--        <a class="navbar-brand" href="#">BulletinBoard</a>-->
        <router-link class="navbar-brand" to="/">BulletinBoard</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-left">
                <li class="nav-item" :class="{active: (getRouteName === 'main')}">
                    <router-link class="nav-link" to="/">Главная</router-link>
                </li>
                <li class="nav-item" :class="{active: (getRouteName === 'personal')}">
                    <router-link class="nav-link" to="/personal">Личный кабинет</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/sing-in" @click.native="exit()">Выйти</router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import {mapMutations} from 'vuex';

    export default {
        data(){
            return {
                routeName: this.$router.currentRoute.name
            }
        },
        watch: {
            '$route'(to, from) {
                this.routeName = to;
            },
        },
        computed:{
            getRouteName(){
                return this.routeName;
            }
        },
        methods:{
            exit() {
                this.logOut();
            },
            ...mapMutations('user', {
                logOut: 'LOG_OUT'
            })
        }
    }
</script>

<style>
    /*mr-auto*/
    .mr-left{
        margin-left: auto !important;
    }
</style>
