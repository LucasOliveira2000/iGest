<script setup>
import PrimaryButton from '../../Components/PrimaryButton.vue'
import AutenticatedLayout from '../../Components/AutenticatedLayout.vue'
import { reactive } from 'vue';
import {router} from '@inertiajs/vue3';
import { defineProps } from 'vue';


const props = defineProps({
    produtos: Object
})

const form = reactive({
    nome: props.produtos.nome ,
    marca: props.produtos.marca ,
    quantidade: props.produtos.quantidade ,
    valor: props.produtos.valor ,
});


function submit() {

  if (typeof form.valor === 'string') {
      form.valor = form.valor.replace(',', '.');
  }

    router.post('/store' , form)
}


</script>

<template>
  <AutenticatedLayout>
      <div class="container">
          <div class="title">
              <h1>Cadastro de Produtos</h1>
          </div>
          <form @submit.prevent="submit" class="form" enctype="multipart/form-data">
              <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input id="nome" type="text" v-model="form.nome">
              </div>
              <div class="form-group">
                  <label for="marca">Marca:</label>
                  <input id="marca" type="text" v-model="form.marca">
              </div>
              <div class="form-group">
                  <label for="quantidade">Quantidade:</label>
                  <input id="quantidade" type="number" v-model.number="form.quantidade">
              </div>
              <div class="form-group">
                  <label for="valor">Valor:</label>
                  <input id="valor" type="text" v-model.number="form.valor">
              </div>
              
              <div class="button-group">
                  <PrimaryButton type="submit">Cadastrar</PrimaryButton>
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
}

.title{
    font-family: Arial, Helvetica, sans-serif;
    margin-top: 20px;
}

.form {
  width: 300px;
  margin-bottom: 20px;
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
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.button-group {
  display: flex;
  justify-content: center;
  gap: 20px;
}
</style>