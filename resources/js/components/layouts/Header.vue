<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
        <a class="navbar-brand" href="#">BulletinBoard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-left">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Главная <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Личный кабинет</a>
                </li>
                <li class="nav-item">
                    <router-link to="/sing-in" @click.native="exit()">Выйти</router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import {mapMutations} from 'vuex';

    export default {
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
