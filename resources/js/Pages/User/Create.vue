<script setup>
import PrimaryButton from '../../Components/PrimaryButton.vue';
import Autenticated from '../../Components/AutenticatedLayout.vue';
import { defineProps } from 'vue';
import { reactive } from 'vue';
import {router} from '@inertiajs/vue3';


const props = defineProps({
    user: Object
})


const form = reactive({
    name: props.user.name,
    email: props.user.email,
    password: props.user.password,
    remember_token: props.user.remember_token
});

function handleChange() {
    form.remember_token = !form.remember_token;
}

function submit() {

  router.post('/user' , form)
}

</script>


<template>
    <Autenticated>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Registro</title>
        </head>

        <section class="section">
            <form @submit.prevent="submit" class="form" enctype="multipart/form-data">

                <div class="login_nome">
                    <label for="name">Nome:</label><br>
                    <input id="name" type="text" v-model="form.name"><br>
                </div>

                <div class="login_email">
                    <label for="email">Email: </label><br>
                    <input placeholder="Digite seu email" type="text" v-model="form.email"><br>
                </div>
                
                <div class="login_senha">
                    <label for="password">Senha: </label><br>
                    <input placeholder="Digite sua senha" type="password" v-model="form.password"><br>
                </div>

                <div class="lembrar_senha">
                    <label>Lembrar senha?</label>
                    <input class="checkbox" type="checkbox" v-model="form.remember_password" @change="handleChange">
                </div>

                <div class="button_login">
                    <PrimaryButton type="submit">Registrar</PrimaryButton>
                </div>


            </form>
        </section>
    </Autenticated>

</template>

<style>

.section{
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
    margin-top: 25vh;
    padding: 10px;
    background-color: #ccc;
    border: 2px solid black;
    border-radius: 5rem;
    width: 30rem;
}

.form{
    background-color: #ccc;
}

.login_nome{
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: white;
    text-shadow: 3px 0px 7px rgba(0, 0, 0, 0.8), -3px 0px 7px rgba(0, 0, 0, 0.8), 0px 4px 7px rgba(0, 0, 0, 0.8);
}


.login_email{
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: white;
    text-shadow: 3px 0px 7px rgba(0, 0, 0, 0.8), -3px 0px 7px rgba(0, 0, 0, 0.8), 0px 4px 7px rgba(0, 0, 0, 0.8);
}

.login_senha{
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: white;
    text-shadow: 3px 0px 7px rgba(0, 0, 0, 0.8), -3px 0px 7px rgba(0, 0, 0, 0.8), 0px 4px 7px rgba(0, 0, 0, 0.8);
}

.lembrar_senha{
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-bottom: 30px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: white;
    text-shadow: 3px 0px 7px rgba(0, 0, 0, 0.8), -3px 0px 7px rgba(0, 0, 0, 0.8), 0px 4px 7px rgba(0, 0, 0, 0.8);
}

.checkbox{
    display: flex;
    margin-left: 20px;
}

.button_login{
    display: flex;
    justify-content: center;
    align-items: center;
}



</style>




