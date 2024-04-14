<script setup>
import PrimaryButton from '../../Components/PrimaryButton.vue'
import SecondLayout from '../../Components/SecondLayout.vue';
import { reactive } from 'vue';
import {router} from '@inertiajs/vue3';
import { defineProps } from 'vue';


const props = defineProps({
    contatos: Object,
    errors: Object
})

const form = reactive({
    nome: props.contatos.nome,
    email: props.contatos.email,
    telefone: props.contatos.telefone,
    mensagem: props.contatos.mensagem,
});

function formatTelephone(event) {
  form.telefone = event.target.value.replace(/\D/g, ''); // Remove qualquer caractere que não seja número
}

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
          <input class="input_produto" id="nome" type="text" v-model="form.nome" required>
          <span v-if="errors.nome" class="error">{{ errors.nome }}</span>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input class="input_produto" id="email" type="text" v-model="form.email" required>
          <span v-if="errors.email" class="error">{{ errors.email }}</span>
        </div>
        <div class="form-group">
          <label for="telefone">Telefone:</label>
          <input class="input_produto" id="telefone" type="text" v-model.integer="form.telefone" @input="formatTelephone" required>
          <span v-if="errors.telefone" class="error">{{ errors.telefone }}</span>
        </div>
        <div class="form-group">
          <label for="mensagem">Mensagem:</label>
          <input class="input_produto" id="mensagem" type="text" v-model="form.mensagem" required>
          <span v-if="errors.mensagem" class="error">{{ errors.mensagem }}</span>
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

.error {
  color: red; /* Cor vermelha para destacar o erro */
  font-size: 0.8rem; /* Tamanho da fonte menor para as mensagens de erro */
  margin-top: 0.2rem; /* Margem superior pequena para separar do campo de entrada */
}

@media (max-width: 625px) {
  .container {
    margin: 5rem 1rem; /* Alterado para um espaçamento menor */
  }

  .form {
    width: 90%; /* Alterado para ocupar 90% da largura */
  }
}

</style>
