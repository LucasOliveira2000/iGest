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

                <div class="cadastro">
                    <h1 class="h1_cadastro">Cadastro</h1>
                </div>

                <div class="login_nome">
                    <label for="name">Nome:</label><br>
                    <input class="input_login" id="name" type="text" v-model="form.name"><br>
                </div>

                <div class="login_email">
                    <label for="email">Email: </label><br>
                    <input class="input_login" placeholder="Digite seu email" type="text" v-model="form.email"><br>
                </div>
                
                <div class="login_senha">
                    <label for="password">Senha: </label><br>
                    <input class="input_login" placeholder="Digite sua senha" type="password" v-model="form.password"><br>
                </div>

                <div class="lembrar_senha">
                    <a href="/login" class="login">Já possui conta?</a>
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
    border: 1px solid #1D6791;
    border-radius: 5rem;
    width: 30rem;
    color: #ffffff;
    box-shadow: 4px 4px rgb(29, 103, 145);
    
}

.cadastro{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 25px;
    color: #1D6791;
    box-shadow: 4px 4px rgb(29, 103, 145);
}

.login_nome{
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #1D6791;
    
}


.login_email{
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #1D6791;
}

.login_senha{
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #1D6791;
}

.lembrar_senha{
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-bottom: 30px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #1D6791;
}

.checkbox{
    display: flex;
    margin-top: 1px;
    margin-left: 20px;
}

.input_login{
    display: flex;
    position: center;
    text-align: center;
    height: 25px;
    border-radius: 20px;
    color: black;
}

.button_login{
    display: flex;
    justify-content: center;
}

.login{
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
    margin-bottom: 10px;
    font-size: 16px;
    color: #1d7691;
    box-shadow: 0px 2px rgb(29, 103, 145);
}

.login:hover{
    color: rgb(0, 207, 17);
}

@media (max-width: 507px) {
  .section {
    width: 260px; /* Alterado para um espaçamento menor */
  }
}


</style>




