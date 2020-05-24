<template>
    <div class="row personal">
        <form>
            <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10">
                <label for="sing-up-name">Имя</label>
                <input v-model.trim="form.name"
                       type="text"
                       class="form-control"
                       id="sing-up-name"
                       placeholder="Введите ваше имя"
                       @blur="$v.form.name.$touch()"
                >
            </div>
            <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10">
                <label for="sing-up-name">email</label>
                <input v-model.trim="form.name"
                       type="text"
                       class="form-control"
                       id="sing-up-email"
                       placeholder="Введите ваше имя"
                       @blur="$v.form.name.$touch()"
                >
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    name: null,
                    email: null,
                }
            }
        }
    }
</script>

<style>
    .personal {
        /*width: 1024px;*/
        background-color: #F0FFFF;
        border: 1px solid #DCDCDC;
        border-radius: 0 0 4px 4px;
    }
</style>
