<script setup>
import PrimaryButton from '../../Components/PrimaryButton.vue';
import Autenticated from '../../Components/AutenticatedLayout.vue';
import { defineProps } from 'vue';
import { reactive } from 'vue';
import {router} from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
    errorMessage: String
})

function mensagem(msg) {
  toast.success(msg, {
      position: "top-center",
      theme: 'colored',
      autoClose: 2000,
      singleton: true,
      multiple: false
  });
}

const form = reactive({
    email: '',
    password: '',
    errorMessage: ''
});

async function submit() {
    form.errorMessage = '';

    if (!form.email || !form.password) {
        form.errorMessage = 'Por favor, preencha todos os campos.';
        return;
    }

    try {
        router.post('/login/store', form);
    
    } catch (error) {
        form.errorMessage = 'Credenciais inválidas. Por favor, tente novamente.';

        setTimeout(() => {
            form.errorMessage = '';
        }, 2000);
    }
}

</script>

<template>
    <Autenticated >
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
        </head>

        <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
        
        <section class="section_1">
            <form  @submit.prevent="submit" class="form.login" enctype="multipart/form-data">
                <div class="h1_div">
                    <h1 class="h1_login">Login</h1>
                </div>

                <div class="login_email">
                    <label for="email">Email:</label><br>
                    <input class="input_login" placeholder="Digite seu email" type="text" v-model="form.email" required><br>
                </div>
                
                <div class="login_senha">
                    <label for="password">Senha: </label><br>
                    <input class="input_login" placeholder="Digite sua senha" type="password" v-model="form.password" required><br>
                    <a href="/user/create" class="registro">Se cadastre aqui!</a>

                    <PrimaryButton type="submit">Entrar</PrimaryButton>
                </div>

            </form>
        </section>
    </Autenticated>

</template>

<style>

.error-message {
    display: flex;
    justify-content: center;
    align-items: center;
    color: red;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 20px;
    margin-top: 30px;
    text-shadow: 3px 0px 7px rgba(0, 0, 0, 0.8), -3px 0px 7px rgba(219, 198, 198, 0.8), 0px 4px 7px rgba(0, 0, 0, 0.8);
    
}

.section_1{
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
    margin-top: 25vh;
    padding: 10px;
    border: 1px solid #1D6791;
    border-radius: 5rem;
    width: 30rem;
    box-shadow: 4px 4px rgb(29, 103, 145);
}

.h1_div{
   display: flex;
   justify-content: center;
   align-items: center;
   margin-bottom: 20px;
   font-family: Arial, Helvetica, sans-serif;
   font-size: 25px;
   color: #1D6791;
   box-shadow: 4px 4px rgb(29, 103, 145);
}


.login_email {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    margin-top: 5vh;
    color: #1D6791;
}

.login_senha {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #1D6791;
}

.input_login{
    display: flex;
    position: relative;
    text-align: center;
    height: 25px;
    border-radius: 20px;
    color: black;
}

.registro{
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
    margin-bottom: 25px;
    font-size: 16px;
    color: #1d7691;
    box-shadow: 0px 2px rgb(29, 103, 145);
    
}

.registro:hover{
    color: rgb(0, 207, 17);
}

@media (max-width: 507px) {
  .section_1 {
    width: 260px; /* Alterado para um espaçamento menor */
  }
}

</style>