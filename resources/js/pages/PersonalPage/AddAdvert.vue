<template>
    <div class="row personal">
        <div class="col-xs-8 col-sm-6 col-md-8 mr-auto mr-vertical-50">
            <form>
                <h3>Добавление объявления.</h3>
                <div class="form-group">
                    <label for="advert-headline">Заголовок объявления</label>
                    <input
                        type="email"
                        class="form-control"
                        id="advert-headline"
                        placeholder="Введите заголовок объявления"
                        v-model.trim="form.headline"
                        @blur="$v.form.headline.$touch()"
                    >
                </div>

                <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator" v-if="$v.form.headline.$error">
                    <template v-if="!$v.form.headline.required">
                        Поле обязательно к заполнению.
                    </template>
                    <template v-if="!$v.form.headline.maxLength">
                        Длина заголовка не должна превышать {{ $v.form.headline.$params.maxLength.max }} символов
                    </template>
                </div>

                <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator" v-if="this.errors.hasOwnProperty('headline')">
                    <template>
                        {{this.errors.headline[0]}}
                    </template>
                </div>

                <div class="form-group">
                    <label for="advert-text">Текст объявления</label>
                    <textarea
                        class="form-control"
                        id="advert-text"
                        rows="3"
                        v-model.trim="form.text"
                        @blur="$v.form.text.$touch()"
                    ></textarea>
                </div>

                <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator" v-if="$v.form.text.$error">
                    <template v-if="!$v.form.text.required">
                        Поле обязательно к заполнению.
                    </template>
                    <template v-if="!$v.form.text.maxLength">
                        Длина поля не должна превышать {{ $v.form.text.$params.maxLength.max }} символов
                    </template>
                </div>

                <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator" v-if="this.errors.hasOwnProperty('text')">
                    <template>
                        {{this.errors.text[0]}}
                    </template>
                </div>

                <div class="form-group">
                    <input
                        type="file"
                        class="form-control-file"
                        id="advert-image"
                        @change="addFile"
                    >
                </div>

                <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator" v-if="$v.form.image.$error">
                    <template v-if="!$v.form.image.required">
                        Вы не добавили изображение!
                    </template>
                </div>

                <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 error-validator" v-if="this.errors.hasOwnProperty('image')">
                    <template>
                        {{this.errors.image[0]}}
                    </template>
                </div>

                <div class="form-group">
                    <button
                        class="btn btn-primary"
                        @click.prevent="sendData()"
                        @disabled="this.sending"
                    >
                        Отправить
                    </button>
                </div>

                <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 loading" v-if="this.sending">
                    <template>
                        Идет отправка...
                    </template>
                </div>

                <div class="form-group mr-auto col-xs-4 col-sm-10 col-md-10 done" v-if="this.statusCode === 201">
                    <template>
                        Успешно добавлено
                    </template>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import {maxLength, required} from "vuelidate/lib/validators";
    import {mapGetters} from "vuex"

    export default {
        data() {
            return {
                form: this.defaultData(),
                errors: {},
                statusCode: null,
                sending: false
            }
        },
        validations: {
            form: {
                headline: {
                    required,
                    maxLength: maxLength(50),
                },
                text: {
                    required,
                    maxLength: maxLength(255),
                },
                image: {
                    required
                },
            }
        },
        computed:{
            ...mapGetters("user",{
                jwt: "isAuthenticated"
            })
        },
        methods: {
            sendData() {
                if (this.checkForm() && !this.$v.$invalid) {
                    this.sending = true;
                    this.statusCode = null;
                    axios.post("api/user/advert", this.prepareData())
                        .then((response) => {
                            this.statusCode = response.status;
                            this.resetForm();
                        }).catch((error) => {
                            this.errors = error.response.data.errors;
                        }).then(() => {this.sending = false;});
                }
            },
            prepareData() {
                let data = new FormData();
                for (let prop in this.form) {
                    data.append(prop, this.form[prop])
                }
                data.append("jwt", this.jwt);

                return data;
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
            addFile(event) {
                this.form.image = event.target.files[0];
            },
            resetForm() {
                this.$data.form = this.defaultData();
                Object.assign(this.$data.form, this.defaultData());
                this.$v.$reset();
            },
            defaultData() {
                return {
                    form: {
                        headline: null,
                        text: null,
                        image: null,
                    },
                }
            }
        }
    }
</script>

<style scoped>
    .personal {
        background-color: #F0FFFF;
        border: 1px solid #DCDCDC;
        border-radius: 0 0 4px 4px;
    }

    .mr-auto {
        margin-right: auto;
        margin-left: auto;
    }

    .mr-vertical-50 {
        margin-top: 50px;
        margin-bottom: 50px;
    }

    .error-validator {
        color: #D8000C;
        text-align: center;
    }

    .loading {
        color: #1E90FF;
        text-align: center;
    }

    .done {
        color: #32CD32;
        text-align: center;
    }
</style>
