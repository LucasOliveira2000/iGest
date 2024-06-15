<script setup>

import PrimaryButton from '../../Components/PrimaryButton.vue';
import SecondLayout from '../../Components/SecondLayout.vue';
import SecondaryButton from '../../Components/SecondaryButton.vue';
import {router} from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';

const props = defineProps({
    produtos: Object
})

function formatValue(valor) {
  if (typeof valor === 'number') {
      return valor.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  } else if (typeof valor === 'string' && !isNaN(parseFloat(valor))) {
      return parseFloat(valor).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }
  return valor;
}

function mensagem(msg) {
  toast.success(msg, {
      position: "top-center",
      theme: 'colored',
      autoClose: 2000,
      singleton: true,
      multiple: false
  });
}

function create() {
    router.get('/create');
}

function edit(id) {
    router.get(`/produto/edit/${id}`);
}

function destroy(id){
  router.delete(`/produto/${id}`)
}

</script>

<template>
  <SecondLayout>
    <head>
      <title>Produtos</title>
    </head>
    <div v-if="$page.props.flash.message" class="sucess">
        {{ mensagem($page.props.flash.message)}}
    </div>
    <div class="div_criar">
        <PrimaryButton @click="create">Cadastrar</PrimaryButton>
    </div>
    
    <section class="section-itens">
      <div class="card-container">
        <div v-for="produto in produtos" :key="produto.id" class="card">
            <p class="paragrafo_title">Produto N°{{ produto.id }}</p>
          <div class="card-content">
            <td>
                <img v-if="produto.imagem" :src="'/storage/produtos/' + produto.imagem" class="imagem" width="150" height="100"/>
                <span v-else>Imagem não disponível</span>
            </td>
            <p class="p">Nome: {{ produto.nome }}</p>
            <p>Marca: {{ produto.marca }}</p>
            <p>Quantidade: {{ produto.quantidade }}</p>
            <p>Valor: {{ "R$ " + formatValue(produto.valor) }}</p>
          
          <div class="card-buttons">
            <PrimaryButton @click="edit(produto.id)">Editar</PrimaryButton>
            <SecondaryButton @click="destroy(produto.id)">Excluir</SecondaryButton>
          </div>
        </div>
        </div>
      </div>
    </section>

  </SecondLayout>
</template>

<style>
.section-itens {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 40px;
}

.card-container {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 30px;
  margin-bottom: 40px;
  background-color: white;
  padding: 20px;
  
}

.paragrafo_title{
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 20px;
  color: black;
  box-shadow: 4px 4px rgb(29, 103, 145);
}

.card {
  display: flex;
  flex-direction: column;
  gap: 20px;
  padding: 40px;
  width: 210px;
  margin: 2vh;
  border: 1px solid rgb(29, 103, 145);
  box-shadow: 4px 4px rgb(29, 103, 145);
}

.card-content {
  display: grid;
  font-family: Arial, Helvetica, sans-serif;
  gap: 10px;
}

.card-buttons {
  display: flex;
  margin-top: 10px;
  gap: 15px;
}

.div_criar {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 40px;
}

.p{
  display: flex;
  margin-top: 10px;
}

.imagem{
  display: flex;
  margin: 0 auto;
  box-shadow: 2px 4px 5px rgb(29, 103, 145);
}

/* Adicionando media query para telas menores */
@media screen and (max-width: 768px) {
  .card-container {
    padding: 10px; /* Reduzindo o padding para telas menores */
  }

  .imagem{
    display: flex;
    margin: 0 auto;
  }

  .card {
    width: calc(50% - 40px); /* Reduzindo a largura do card para telas menores */
  }
}
</style>