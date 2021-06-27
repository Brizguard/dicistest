<template>
    <div>
        <h1>Add</h1>
        <form class="uk-form-stacked">
            <div class="uk-margin">
                <label class="uk-form-label">Имя</label>
                <div class="uk-form-controls">
                    <input class="uk-input"
                           @input = "$v.form.first_name.$touch()"
                           v-model = "form.first_name"
                           :class="{'uk-form-danger': $v.form.first_name.$error}"
                           type="text"
                    >
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Отчество</label>
                <div class="uk-form-controls">
                    <input class="uk-input"
                           @input = "$v.form.second_name.$touch()"
                           v-model = "form.second_name"
                           :class="{'uk-form-danger': $v.form.second_name.$error}"
                           type="text"
                    >
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Фамилия</label>
                <div class="uk-form-controls">
                    <input class="uk-input"
                           @input = "$v.form.surname.$touch()"
                           v-model = "form.surname"
                           :class="{'uk-form-danger': $v.form.surname.$error}"
                           type="text" >
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" >Email</label>
                <div class="uk-form-controls">
                    <input
                            @blur = "$v.form.email.$touch()"
                            class="uk-input"
                            v-model.lazy = "form.email"
                            :class="{'uk-form-danger': $v.form.email.$error}"
                            type="email"
                    >
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">День рождения</label>
                <div class="uk-form-controls">
                    <input type ="date" class="uk-input"
                           @input = "$v.form.birthday.$touch()"
                           v-model = "form.birthday"
                           :class="{'uk-form-danger': $v.form.birthday.$error}"
                    >
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" >Авто</label>
                <div class="uk-form-controls">
                    <input class="uk-input"
                           v-model = "form.auto"
                           type="text" >
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" >Марка</label>
                <div class="uk-form-controls">
                    <input class="uk-input"
                           @input = "$v.form.mark.$touch()"
                           v-model = "form.mark"
                           :class="{'uk-form-danger': $v.form.mark.$error}"
                           type="text" >
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" >Модель</label>
                <div class="uk-form-controls">
                    <input class="uk-input"
                           @input = "$v.form.model.$touch()"
                           v-model = "form.model"
                           :class="{'uk-form-danger': $v.form.model.$error}"
                           type="text" >
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" >Кол-во детей</label>
                <div class="uk-form-controls">
                    <input class="uk-input" v-model = "childrenCount" type="text" >
                </div>
            </div>



            <div v-if = "childrenCount > 0" >
                <div  v-for="(v, index) in $v.childrenFields.$each.$iter">
                    <div class="uk-margin">
                        <label class="uk-form-label">Имя</label>
                        <div class="uk-form-controls">
                            <input class="uk-input"
                                   v-model.trim="v.first_name.$model"
                                   :class="{'uk-form-danger': v.first_name.$error}"
                                   type="text" >

                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">Отчество</label>
                        <div class="uk-form-controls">
                            <input class="uk-input"
                                   v-model.trim="v.second_name.$model"
                                   :class="{'uk-form-danger': v.second_name.$error}"
                                   type="text" >
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">Фамилия</label>
                        <div class="uk-form-controls">
                            <input class="uk-input"
                                   v-model.trim="v.surname.$model"
                                   :class="{'uk-form-danger': v.surname.$error}"
                                   type="text" >
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">email</label>
                        <div class="uk-form-controls">
                            <input class="uk-input"
                                   v-model.trim.lazy="v.email.$model"
                                   :class="{'uk-form-danger': v.email.$error}"
                                   type="email" >
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">День рождения</label>
                        <div class="uk-form-controls">
                            <input class="uk-input"
                                   v-model.trim.lazy="v.birthday.$model"
                                   :class="{'uk-form-danger': v.birthday.$error}"
                                   type ="date" >
                        </div>
                    </div>
                    <hr>
                </div>

            </div>

            <div class="uk-margin">
                <button class="uk-button uk-button-default" @click.prevent = "store" >Отправить</button>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';
    import { required, email, helpers, minLength } from 'vuelidate/lib/validators'
    const alpha = helpers.regex('alpha', /^[А-Яа-яЁё]*$/);

    export default {
       components:{

       },
        data: () => ({
            form: {
                first_name: "",
                second_name: "",
                surname: "",
                email: "",
                birthday: "",
                mark: "",
                model: "",
                auto: "",
                children: []
            },
            childrenCount:0,
            childrenFields:[],
            submitStatus:'',
        }),

        watch:{
            childrenCount(){
                this.childrenFields = [];

                for(let i = 0; i < this.childrenCount; i++){
                    this.childrenFields.push({
                        first_name: "",
                        second_name: "",
                        surname: "",
                        email: "",
                        birthday: "",
                    });
                }

            }
        },
        validations:{
           form:{
               first_name:{
                   required,
                   minLength:1,
                   alpha:alpha
               },
               second_name:{
                   required,
                   minLength:1,
                   alpha:alpha
               },
               surname:{
                   required,
                   minLength:1,
                   alpha:alpha
               },
               birthday:{
                   required,
                   minLength:1
               },
               mark:{
                   required,
               },
               model:{
                   required,
               },
               email: {
                   required,
                   email,
                   uniqEmail: function (newEmail) {
                       if(!newEmail) return false;
                       return axios.post('/checkmail', {'email' : newEmail, 'table' : 'people'}, {
                            headers: {
                                "Content-type": "application/json"
                                    }
                                }).then( res => {
                                   if(res.data.checkHaveError)
                                       return false;
                                   else
                                       return true;
                                });

                   }
               }
           },

           childrenFields:{
               $each: {
                   first_name: {
                       required,
                       minLength:1,
                       alpha:alpha
                   },
                   second_name:{
                       required,
                       minLength:1,
                       alpha:alpha
                   },
                   surname:{
                       required,
                       minLength:1,
                       alpha:alpha

                   },
                   birthday:{
                       required,
                       minLength:1
                   },
                   email: {
                       required,
                       email,
                       uniqEmail: function (newEmail) {
                           if(!newEmail) return false;


                         return axios.post('/checkmail', {'email' : newEmail, 'table' : 'childrens'}, {
                               headers: {
                                   "Content-type": "application/json"
                               }
                           }).then( res => {
                               if(res.data.checkHaveError)
                                  return false;
                               else
                                   return true;
                           });

                       }
                   }
               }
           }
        },

        methods:{
            store(){
                this.$v.$touch();
                if (this.$v.$invalid) {
                    this.submitStatus = 'ERROR'
                } else {

                    this.form.children = this.childrenFields;

                    axios.post('/api/people', this.form, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    }).then( res => {
                        if(res.data.status){
                            this.$router.push('/people/'+ res.data.people.id);
                        }
                    }).catch(error=>{
                        //console.log(error.responce.data);
                    });
                    this.submitStatus = 'SUCCESS'
                }

                console.log(this.submitStatus);
            }
        }
    }
</script>