<script setup>

import PrimaryButton from '../../Components/PrimaryButton.vue'
import AutenticatedLayout from '../../Components/AutenticatedLayout.vue'
import SecondaryButton from '../../Components/SecondaryButton.vue'
import {router} from '@inertiajs/vue3';


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


function create(){
  router.get('/create')
}

function edit(id){
  router.get(`/produto/edit/${id}`)
}

function destroy(id){
  router.delete(`/produto/${id}`).then(() => {
    alert('Produto deletado com sucesso!')
    router.back()
  }).catch(error => {
    console.error('Erro ao deletar o produto:', error)
  })
}

</script>

<template>
  <AutenticatedLayout>
    <head>
      <title>Produtos</title>
    </head>
    <div class="div_criar">
        <PrimaryButton @click="create">Cadastrar</PrimaryButton>
    </div>
    
    <section class="section-itens">
      <div class="card-container">
        <div v-for="produto in produtos" :key="produto.id" class="card">
            <p class="paragrafo_title">Produto N°{{ produto.id }}</p>
          <div class="card-content">
            <p>Nome: {{ produto.nome }}</p>
            <p>Marca: {{ produto.marca }}</p>
            <p>Quantidade: {{ produto.quantidade }}</p>
            <p>Valor: {{ formatValue(produto.valor) }}</p>
            
          </div>
          <div class="card-buttons">
            <PrimaryButton @click="edit(produto.id)">Editar</PrimaryButton>
            <SecondaryButton @click="destroy(produto.id)">Excluir</SecondaryButton>
          </div>
        </div>
      </div>
    </section>

  </AutenticatedLayout>
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
}

.card {
  display: flex;
  flex-direction: column;
  gap: 40px;
  padding: 20px;
  width: 210px;
  margin: 2vh;
  background-color: rgb(210, 216, 216);
  border: 3px solid black;
}

.card-content {
  display: grid;
  font-family: Arial, Helvetica, sans-serif;
  gap: 5px;
}

.card-buttons {
  display: flex;
  gap: 10px;
}

.div_criar {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 40px;
}

/* Adicionando media query para telas menores */
@media screen and (max-width: 768px) {
  .card-container {
    padding: 10px; /* Reduzindo o padding para telas menores */
  }
  .card {
    width: calc(50% - 40px); /* Reduzindo a largura do card para telas menores */
  }
}
</style>