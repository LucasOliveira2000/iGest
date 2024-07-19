<script setup>

import PrimaryButton from '../../Components/PrimaryButton.vue';
import Autenticated from '../../Components/AutenticatedLayout.vue';
import { defineProps, reactive, watch, nextTick } from 'vue';
import { router } from '@inertiajs/vue3';
import { Flip, toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';  // Importando o CSS do vue3-toastify

const props = defineProps({
    user: Object,
    errors: Object,
    flash: Object
});

function mensagem(msg) {
  toast.error(msg, {
      position: "top-center",
      theme: 'colored',
      autoClose: 2000,
      singleton: true,
      multiple: false,
      transition: Flip
  });
}

watch(() => props.flash, async (newFlash) => {
  await nextTick();
  if (newFlash?.message) {
    mensagem(newFlash.message);
  }
}, { immediate: true });

const form = reactive({
    email: '',
    password: ''
});

function submit() {
    router.post('/login/store', form);
}

</script>

<template>
    <Autenticated >
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
        </head>

        <section class="section_1">
            <form  @submit.prevent="submit" class="form.login" enctype="multipart/form-data">
                <div class="h1_div">
                    <h1 class="h1_login">Login</h1>
                </div>

                <div class="login_email">
                    <label for="email">Email:</label><br>
                    <input class="input_login" placeholder="Digite seu email" type="text" v-model="form.email" required>
                    <span v-if="errors.email" class="error">{{ errors.email }}</span>
                </div>

                <div class="login_senha">
                    <label for="password">Senha: </label><br>
                    <input class="input_login" placeholder="Digite sua senha" type="password" v-model="form.password" required>
                    <span v-if="errors.senha" class="error">{{ errors.senha }}</span>
                    <a href="/user/create" class="registro">Se cadastre aqui!</a>

                    <PrimaryButton type="submit">Entrar</PrimaryButton>
                </div>
            </form>
        </section>
    </Autenticated>

</template>

<style>

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
    border-radius: 5px 60px;
    box-shadow: 2px 2px 25px 2px #006DA4;
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
    margin-top: 5px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #1D6791;
}

.input_login{
    display: flex;
    position: relative;
    text-align: center;
    margin-bottom: 10px;
    height: 25px;
    border-radius: 20px;
    color: black;
}

.registro{
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
    margin-top: 15px;
    margin-bottom: 25px;
    font-size: 16px;
    color: #1d7691;
    box-shadow: 0px 2px rgb(29, 103, 145);

}

.error {
  color: red; /* Cor vermelha para destacar o erro */
  font-size: 0.8rem; /* Tamanho da fonte menor para as mensagens de erro */
  margin-top: 1px; /* Margem superior pequena para separar do campo de entrada */
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
