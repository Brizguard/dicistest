<template>
    <div>
        <h1>{{ fio }}</h1>

        <div v-if = "!not_found">
            <p> Имя: {{ element.first_name }}</p>
            <p> Отчество: {{ element.second_name }}</p>
            <p> Фамилия: {{ element.surname }}</p>
            <p>День рождения: {{ element.birthday }}</p>
            <p>Марка: {{ element.mark }}</p>
            <p>Модель: {{ element.model }}</p>
            <p>Авто: {{ element.auto }}</p>
            <hr>
            <div v-if="element.children.length">
                <p>Дети:</p>
                <div v-for="item in element.children">
                    <p>Имя: {{item.first_name}}</p>
                    <p>Отчество: {{item.second_name}}</p>
                    <p>Фамилия: {{item.surname}}</p>
                    <hr>
                </div>
            </div>
        </div >
        <div v-if = "not_found">
            <p> Элемент не найден </p>
        </div >

    </div>
</template>

<script>
    import axios from "axios";
    export default {

        data:()=>({
           element:[],
           not_found:false
        }),

        mounted(){
            this.loadElement(this.$route.params.id)
        },
        computed: {
            fio: function () {
                return  this.element.first_name+' '+this.element.second_name+' '+this.element.surname;
            }
        },

        methods: {
            loadElement(id){
                axios.get('/api/people/'+id).then(
                    response => {
                        this.element = response.data;
                    }
                ).catch(error => {
                    this.not_found = true;
                })
            }
        }

    }
</script>