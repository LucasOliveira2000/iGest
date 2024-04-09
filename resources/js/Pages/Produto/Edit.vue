<script setup>
import PrimaryButton from '../../Components/PrimaryButton.vue';
import SecondLayout from '../../Components/SecondLayout.vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { reactive } from 'vue';
import {router} from '@inertiajs/vue3';
import { defineProps } from 'vue';


const props = defineProps({
    produtos: Object,
    errors: Object,
    toast: String
})

const form = reactive({
    nome: props.produtos.nome ,
    marca: props.produtos.marca ,
    quantidade: props.produtos.quantidade ,
    valor: props.produtos.valor
});

function formatCurrency(event) {
    let cleanedValue = event.target.value.replace(/[^\d.,]/g, '');

    cleanedValue = cleanedValue.replace(/,/g, '.');

    form.valor = cleanedValue;
}


function submit() {
  const produtoID = props.produtos.id
  router.put(`/produto/update/${produtoID}`, form);
}


</script>

<template>
  <SecondLayout>
      <head>
        <title>Atualizar Produto</title>
      </head>
      <div class="container">
          <div class="title">
              <h1>Atualizar Produto</h1>
          </div>
          <form @submit.prevent="submit" class="form" enctype="multipart/form-data">
              <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input class="input_produto" id="nome" type="text" v-model="form.nome" required>
                  <span v-if="errors.nome" class="error">{{ errors.nome }}</span>
              </div>
              <div class="form-group">
                  <label for="marca">Marca:</label>
                  <input class="input_produto" id="marca" type="text" v-model="form.marca" required>
                  <span v-if="errors.marca" class="error">{{ errors.marca }}</span>
              </div>
              <div class="form-group">
                  <label for="quantidade">Quantidade:</label>
                  <input class="input_produto" id="quantidade" type="number" v-model.number="form.quantidade" required>
                  <span v-if="errors.quantidade" class="error">{{ errors.quantidade }}</span>
              </div>
              <div class="form-group">
                  <label for="valor">Valor:</label>
                  <input class="input_produto" id="valor" type="text" v-model.money="form.valor" @input="formatCurrency" required>
                  <span v-if="errors.valor" class="error">{{ errors.valor }}</span>
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