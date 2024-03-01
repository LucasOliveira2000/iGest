<script setup>
import PrimaryButton from '../../Components/PrimaryButton.vue'
import AutenticatedLayout from '../../Components/AutenticatedLayout.vue'
import { reactive } from 'vue';
import {router} from '@inertiajs/vue3';
import { defineProps } from 'vue';


const props = defineProps({
    contato: Object,
})

const form = reactive({
    nome: props.contato.nome ,
    email: props.contato.email ,
    telefone: props.contato.telefone ,
    mensagem: props.contato.mensagem ,
});

function formatCurrency(event) {
    // Remove qualquer caractere que não seja número, vírgula ou ponto
    let cleanedValue = event.target.value.replace(/[^\d.,]/g, '');

    // Substitui vírgulas por pontos (formato de ponto flutuante)
    cleanedValue = cleanedValue.replace(/,/g, '.');

    // Atualiza o mensagem do v-model com o mensagem limpo e formatado
    form.telefone = cleanedValue;
}


function submit() {
  router.post('/contato/store' , form)
}


</script>

<template>
  <AutenticatedLayout>
      <head>
        <title>Contato</title>
      </head>
      <div class="container">
          <div class="title">
              <h1>Formulário para Contato</h1>
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
                  <input class="input_produto" id="telefone" type="number" v-model.number="form.telefone"  @input="formatCurrency">
              </div>
              <div class="form-group">
                  <label for="mensagem">Mensagem:</label>
                  <input class="input_produto" id="mensagem" type="text" v-model="form.mensagem">
              </div>
              
              <div class="button-group">
                  <PrimaryButton type="submit">Enviar</PrimaryButton>
              </div>
          </form>
      </div>
  </AutenticatedLayout>
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

    background-color: #1D6791;
    color: white;
    padding: 5px;
    margin-bottom: 40px;
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