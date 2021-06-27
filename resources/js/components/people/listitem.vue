<template>
    <div class="uk-card uk-card-default" style="margin-bottom: 20px; margin-left: 20px">
        <div class="uk-card-header">
            <div class="uk-grid-small uk-flex-middle" uk-grid>
                <div class="uk-width-expand">
                    <h3 class="uk-card-title uk-margin-remove-bottom">{{ first_name }}</h3>
                </div>
            </div>
        </div>
        <div class="uk-card-body">
            <p>Имя: {{ first_name }}</p>
            <p>Отчество: {{ second_name }}</p>
            <p>День рождения {{ birthday }}</p>
        </div>
        <div class="uk-card-footer">
            <a :href="detailUrl" class="uk-button uk-button-text">Открыть карточку</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            first_name: {
                type: String,
                default: "NULL"
            },
            second_name: {
                type: String,
                default: "NULL"
            },
            birthday: {
                type: String,
                default: "NULL"
            },
            detailUrl: {
                type: String,
                default: "NULL"
            }
        }
    }
</script>

<style scoped>

</style>