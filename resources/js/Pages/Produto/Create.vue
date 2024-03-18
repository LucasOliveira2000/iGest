<script setup>
import PrimaryButton from '../../Components/PrimaryButton.vue'
import SecondLayout from '../../Components/SecondLayout.vue';
import { reactive } from 'vue';
import {router} from '@inertiajs/vue3';
import { defineProps } from 'vue';


const props = defineProps({
    produtos: Object,
})

const form = reactive({
    nome: props.produtos.nome ,
    marca: props.produtos.marca ,
    quantidade: props.produtos.quantidade ,
    valor: props.produtos.valor ,
});

function formatCurrency(event) {
    // Remove qualquer caractere que não seja número, vírgula ou ponto
    let cleanedValue = event.target.value.replace(/[^\d.,]/g, '');

    // Substitui vírgulas por pontos (formato de ponto flutuante)
    cleanedValue = cleanedValue.replace(/,/g, '.');

    // Atualiza o valor do v-model com o valor limpo e formatado
    form.valor = cleanedValue;
}


function submit() {
  router.post('/store' , form)
}


</script>

<template>
  <SecondLayout>
      <head>
        <title>Criar Produto</title>
      </head>
      <div class="container">
          <div class="title">
              <h1>Cadastro de Produtos</h1>
          </div>
          <form @submit.prevent="submit" class="form" enctype="multipart/form-data">
              <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input class="input_produto" id="nome" type="text" v-model="form.nome">
              </div>
              <div class="form-group">
                  <label for="marca">Marca:</label>
                  <input class="input_produto" id="marca" type="text" v-model="form.marca">
              </div>
              <div class="form-group">
                  <label for="quantidade">Quantidade:</label>
                  <input class="input_produto" id="quantidade" type="number" v-model.number="form.quantidade">
              </div>
              <div class="form-group">
                  <label for="valor">Valor:</label>
                  <input class="input_produto" id="valor" type="text" v-model.money="form.valor" @input="formatCurrency">
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