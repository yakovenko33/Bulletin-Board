<template>
    <section class="container">
        <div class="row">
            <div
                class="col-md-2 page-toggle"
                :class="{'active-toggle': (currentPage === 'ProfileEditor')}"
                style="padding: 0"
                @click.prevent="choicePage('ProfileEditor')"
            >
                <span>
                    Редактирование профиля
                </span>
            </div>

            <div
                class="col-md-2 page-toggle"
                style="padding: 0"
                :class="{'active-toggle': (currentPage === 'AddAdvert')}"
                @click.prevent="choicePage('AddAdvert')"
            >
                <span>
                    Добавление объявления
                </span>
            </div>

<!--            <div  class="col-md-2" style="padding: 0">-->
<!--                <button class="page-toggle" @click.prevent="choicePage('AddAdvert')">-->
<!--                    Добавление объявления-->
<!--                </button>-->
<!--            </div>-->
        </div>
        <keep-alive>
            <component :is="currentPage"></component>
        </keep-alive>
    </section>
</template>

<script>
    import AddAdvert from "./AddAdvert";
    import ProfileEditor from "./ProfileEditor";

    export default {
        components: {
            AddAdvert: AddAdvert,
            ProfileEditor: ProfileEditor
        },
        data(){
            return {
                currentPage: ProfileEditor,
            }
        },
        methods:{
            choicePage(componentName) {
                this.currentPage = componentName;
            }
        }
    }
</script>

<style>
    .container {
        margin-top: 50px;
        max-width: 1024px;
        margin-left: auto;
        margin-right: auto;
        /*background-color: #1E90FF;*/
    }

    .page-toggle {
        border-radius: 4px 4px 0 0;
        background-color: #F0FFFF;
        cursor: pointer;
        /*border: none;*/
        border: 1px solid #DCDCDC;
        border-bottom: none;
        height: 50px;
        text-align: center;
        /*line-height: 20px;*/
    }

    .page-toggle:hover {
        border-radius: 4px 4px 0 0;
        cursor: pointer;
        background-color: #00BFFF;/*#1E90FF;*+
        border: 1px solid #DCDCDC;
        border-bottom: none;
        /*border: none;*/
        transition: 0.5s;
    }

    .active-toggle { /*:active*/
        background-color: #00BFFF; /*#00BFFF*/
        /*border: none;*/
        transition: background 0s;
    }
</style>
