<template>
    <section class="sing-up">
        <div class="form-sing-up">
            <div class="head-sing-up">
                <p>Регистрация в BulletinBoard</p>
            </div>
            <div class="body-sing-up">
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
                    <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator" v-if="this.$v.form.name.$error">
                        <template v-if="!this.$v.form.name.required || this.errors.name[0]">
                            Поле обязательно к заполнению.
                        </template>
                        <template v-if="!this.$v.form.name.maxLength">
                            Длина имени не должна превышать {{ this.$v.form.name.$params.maxLength.max }} символов
                        </template>
                    </div>

                    <div
                        class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator"
                        v-if="this.errors.hasOwnProperty('name')"
                    >
                        <template>
                            {{this.errors.name[0]}}
                        </template>
                    </div>

                    <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10">
                        <label for="sing-up-surname">Фамилия</label>
                        <input v-model.trim="form.surname"
                               type="text"
                               class="form-control"
                               id="sing-up-surname"
                               placeholder="Введите ваше фамилию"
                               @blur="$v.form.surname.$touch()"
                        >
                    </div>
                    <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator" v-if="$v.form.surname.$error">
                        <template v-if="!$v.form.surname.required">
                            Поле обязательно к заполнению.
                        </template>
                        <template v-if="!$v.form.surname.maxLength">
                            Длина фамилии не должна превышать {{ $v.form.surname.$params.maxLength.max }} символов
                        </template>
                    </div>
                    <div
                        class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator"
                        v-if="this.errors.hasOwnProperty('surname')"
                    >
                        <template>
                            {{this.errors.surname[0]}}
                        </template>
                    </div>

                    <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10">
                        <label for="sing-up-email">Email</label>
                        <input v-model.trim="form.email"
                               type="text"
                               class="form-control"
                               id="sing-up-email"
                               placeholder="Введите ваше email"
                               @blur="$v.form.email.$touch()"
                        >
                    </div>

                    <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator" v-if="$v.form.email.$error">
                        <template v-if="!$v.form.email.required">
                            Поле обязательно к заполнению.
                        </template>
                        <template v-if="!$v.form.email.maxLength">
                            Длина email не должна превышать {{ $v.form.email.$params.maxLength.max }} символов
                        </template>
                        <template v-if="!$v.form.email.email">
                            Email введён не коректно
                        </template>
                    </div>

                    <div
                        class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator"
                        v-if="this.errors.hasOwnProperty('email')"
                    >
                        <template>
                            {{this.errors.email[0]}}
                        </template>
                    </div>

                    <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10">
                        <label for="sing-up-password">Пароль</label>
                        <input v-model.trim="form.password"
                               type="text"
                               class="form-control"
                               id="sing-up-password"
                               placeholder="Введите ваше пароль"
                               @blur="$v.form.password.$touch()"
                        >
                    </div>

                    <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator" v-if="$v.form.password.$error">
                        <template v-if="!$v.form.password.required">
                            Поле обязательно к заполнению.
                        </template>
                        <template v-if="!$v.form.password.maxLength">
                            Длина пароля не должна превышать {{ $v.form.password.$params.maxLength.max }} символов
                        </template>
                    </div>

                    <div
                        class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator"
                        v-if="this.errors.hasOwnProperty('password')"
                    >
                        <template>
                            {{this.errors.password[0]}}
                        </template>
                    </div>

                    <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10" style="text-align: center;">
                        <button class="btn btn-primary button-sing-in"
                                @click.prevent="sendData()"
                                :disabled="this.sending"
                        >
                            Подтвердить
                        </button>
                    </div>

                    <div
                        class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator"
                        v-if="this.errors.hasOwnProperty('database')"
                    >
                        <template>
                            {{this.errors.database[0]}}
                        </template>
                    </div>

                    <div
                        class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator"
                        v-if="this.statusCode === 500"
                    >
                        <template>
                            Проблемы на сервере, попробуйте позже.
                        </template>
                    </div>

                    <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10" style="text-align: center;">
                        <p>Уже в BulletinBoard? <a href="#">Войти</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
    import {required, maxLength, email} from 'vuelidate/lib/validators';
    import {mapGetters, mapMutations} from 'vuex';

    export default {
        data() {
            return {
                form: {
                    name: null,
                    surname: null,
                    email: null,
                    password: null,
                },
                statusCode: null,
                errors: {},
                sending: null,
            }
        },
        validations: {
            form: {
                name: {
                    required,
                    maxLength: maxLength(25),
                },
                surname: {
                    required,
                    maxLength: maxLength(25),
                },
                email: {
                    required,
                    email,
                    maxLength: maxLength(50),
                },
                password: {
                    required,
                    maxLength: maxLength(30),
                },
            }
        },
        mounted() {
        },
        methods:{
            sendData() {
                if (this.checkForm() && !this.$v.$invalid) {
                    this.sending = true;
                    axios.post('/api/user/sing-up', this.form)
                        .then((response) => {
                            this.authenticate(response.data.data.jwt_token);
                            this.$router.push({name: "personal"});
                        }).catch((error) => {
                            this.statusCode = error.response.status;
                            this.errors = error.response.data.errors;
                            this.sending = false;
                        });
                }
            },
            checkForm() {
                for (let prop in this.form) {
                    if (this.form[prop] === null) {
                        this.$v.$touch();
                        return false;
                    }
                }

                return true;
            },
            ...mapMutations('user', {
                authenticate: 'AUTHENTICATE',
            }),
        }
    }
</script>

<style>
    .mr-auto {
        margin-right: auto;
        margin-left: auto;
    }

    .form-sing-up {
        margin-top: 50px;
        margin-right: auto;
        margin-left: auto;
        max-width: 400px;
        border: 1px solid #778899;
        background-color: #F8F8FF;
    }

    .head-sing-up {
        background-color: #406eb4;
        color: #F8F8FF;
        height: 40px;
        line-height: 40px;
        margin-bottom: 20px;
        text-align: center;
    }

    .head-sing-up p {
        height: 20px;
        font-size: 18px;
    }

    .button-sing-up {
        width: 200px;
        background-color: #87CEFA;
        color: #F8F8FF;
    }

    .body-sing-up {
        font-weight: 600;
    }

    .error-validator {
        color: #D8000C;
        text-align: center;
    }

</style>
