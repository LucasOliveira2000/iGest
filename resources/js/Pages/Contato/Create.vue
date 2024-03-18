<script setup>
import PrimaryButton from '../../Components/PrimaryButton.vue'
import SecondLayout from '../../Components/SecondLayout.vue';
import { reactive } from 'vue';
import {router} from '@inertiajs/vue3';
import { defineProps } from 'vue';


const props = defineProps({
    contatos: Object
})

const form = reactive({
    nome: '',
    email: '',
    telefone: '',
    mensagem: '',
});

function submit() {
  router.post('/contato/store' , form)
}

</script>

<template>
  <SecondLayout>
      <head>
        <title>Criar Mensagem</title>
      </head>
      <div class="container">
          <div class="title">
              <h1>Digite Sua Duvida</h1>
          </div>
          <form @submit.prevent="submit" class="form" enctype="multipart/form-data">
              <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input class="input_produto" id="nome" type="text" v-model="form.nome">
              </div>
              <div class="form-group">
                  <label for="email">Email:</label>
                  <input class="input_produto" id="email" type="text" v-model="form.email">
              </div>
              <div class="form-group">
                  <label for="telefone">Telefone:</label>
                  <input class="input_produto" id="telefone" type="text" v-model="form.telefone">
              </div>
              <div class="form-group">
                  <label for="mensagem">Mensagem:</label>
                  <input class="input_produto" id="mensagem" type="text" v-model.money="form.mensagem">
              </div>
              
              <div class="button-group">
                  <PrimaryButton type="submit">Enviar</PrimaryButton>
              </div>
          </form>
      </div>
  </SecondLayout>
</template>


<style>

.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 10rem;
}

.title{
    font-family: Arial, Helvetica, sans-serif;
    margin-top: 20px;
    background-color: #1D6791;
    color: white;
    padding: 5px;
}

.form {
  width: 300px;
  margin-bottom: 20px;
  margin-top: 10px;
  border: 1px solid black;
  background-color: #ccc;
}

.form-group {
  margin: 30px;
  margin-top: 40px;
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
}

.form-group input {
  width: 100%;
  padding: 8px;
  border: 2px solid black;
  border-radius: 4px;
  box-sizing: border-box;
}

.button-group {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-bottom: 1rem;
}

</style>