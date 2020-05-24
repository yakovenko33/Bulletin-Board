<template>
    <div class="row personal">
        <div class="col-xs-8 col-sm-6 col-md-8 mr-auto mr-vertical-50">
            <form>
                <h3>Добавление объявления.</h3>
                <div class="form-group">
                    <label for="advert-headline">Заголовок объявления</label>
                    <input type="email" class="form-control" id="advert-headline" placeholder="Введите заголовок объявления">
                </div>
                <div class="form-group">
                    <label for="advert-text">Текс объявления</label>
                    <textarea class="form-control" id="advert-text" rows="3"></textarea>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: this.defaultData(),
                errors: {},
                statusCode: null,
            }
        },
        methods: {
             defaultData() {
                 return {
                     headline: null,
                     text: null,
                 }
             }
        }
    }
</script>

<style>
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
</style>
