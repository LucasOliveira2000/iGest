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


const form = reactive({
    email: '',
    password: '',
    errorMessage: ''
});

async function submit() {
    // Limpar a mensagem de erro
    form.errorMessage = '';

    // Validar o email e a senha
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
                    <h1>Login</h1>
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
    background-color: #ccc;
    border: 2px solid black;
    border-radius: 5rem;
    width: 30rem;
}

.h1_div{
   display: flex;
   justify-content: center;
   align-items: center;
   margin-bottom: 20px;
   font-family: Arial, Helvetica, sans-serif;
   font-size: 25px;
   color: white;
   text-shadow: 3px 0px 7px rgba(0, 0, 0, 0.8), -3px 0px 7px rgba(219, 198, 198, 0.8), 0px 4px 7px rgba(0, 0, 0, 0.8);
}


.login_email {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    margin-top: 5vh;
    color: white;
    text-shadow: 3px 0px 7px rgba(0, 0, 0, 0.8), -3px 0px 7px rgba(0, 0, 0, 0.8), 0px 4px 7px rgba(0, 0, 0, 0.8);
}

.login_senha {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: white;
    text-shadow: 3px 0px 7px rgba(0, 0, 0, 0.8), -3px 0px 7px rgba(0, 0, 0, 0.8), 0px 4px 7px rgba(0, 0, 0, 0.8);
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
    margin-right: 30px;
    margin-bottom: 10px;
    font-size: 16px;
}

.registro:hover{
    color: rgb(0, 0, 0);
}

</style>