<script setup>
import PrimaryButton from '../../Components/PrimaryButton.vue';
import Autenticated from '../../Components/AutenticatedLayout.vue';
import { defineProps } from 'vue';
import { reactive } from 'vue';
import {router} from '@inertiajs/vue3';


const props = defineProps({
    user: Object,
    errors: Object
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
                    <label for="name">Nome:</label>
                    <input class="input_login" id="name" placeholder="Digite seu Nome" type="text" v-model="form.name" required>
                    <span v-if="errors.name" class="error">{{ errors.name }}</span>
                </div>

                <div class="login_email">
                    <label for="email">Email: </label>
                    <input class="input_login" placeholder="Digite seu Email" type="text" v-model="form.email" required>
                    <span v-if="errors.email" class="error">{{ errors.email }}</span>
                </div>

                <div class="login_senha">
                    <label for="password">Senha: </label>
                    <input class="input_login" placeholder="Digite sua Senha" type="password" v-model="form.password" required>
                    <span v-if="errors.password" class="error">{{ errors.password }}</span>
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
    border-radius: 5px 60px;
    box-shadow: 2px 2px 25px 2px #006DA4;

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
    gap: 15px;
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
    margin-top: 10px;
    gap: 15px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #1D6791;
}

.login_senha{
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    margin-top: 10px;
    gap: 15px;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #1D6791;
}

.lembrar_senha{
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-top: 15px;
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

.error {
  color: red; /* Cor vermelha para destacar o erro */
  font-size: 0.8rem; /* Tamanho da fonte menor para as mensagens de erro */
  margin-bottom: 10px;
}

@media (max-width: 507px) {
  .section {
    width: 260px; /* Alterado para um espaçamento menor */
  }
}


</style>




