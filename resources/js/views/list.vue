<template>
    <div>
        <div style="display:flex; flex-wrap: wrap;">
            <listitem
                    v-for="element in people"
                    :first_name="element.first_name"
                    :second_name="element.second_name"
                    :birthday="element.birthday"
                    :detailUrl="element.detailUrl"

            />
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import listitem from '../components/people/listitem.vue'

    export default {
        components:{
            listitem
        },
        data: () => ({
            people: []
        }),
       mounted(){
            this.loadPeople();
       },
       methods:{
            loadPeople(){
                axios.get('/api/people').then(response => {

                    let people = [];

                    for ( let i in  response.data){
                        response.data[i].detailUrl = "/people/"+response.data[i].id;
                        people.push(response.data[i]);
                    }
                    this.people = people
                })
            }
       }
    }
</script>