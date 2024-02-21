<script setup>

import PrimaryButton from '../../Components/PrimaryButton.vue'
import AutenticatedLayout from '../../Components/AutenticatedLayout.vue'
import SecondaryButton from '../../Components/SecondaryButton.vue'
import {router} from '@inertiajs/vue3';
import { useRouter } from 'vue-router';
import axios from 'axios';


const props = defineProps({
    produtos: Object
})

function formatValue(valor) {
    if (typeof valor === 'decimal') {
        return valor.replace('.', ',');
    }

    return valor;
}


function create(){
  
  router.get('/create')
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
    <div class="div_criar">
        <PrimaryButton @click="create">Criar Produto</PrimaryButton>
    </div>
    
    <section class="section-itens">
      <div class="card-container">
        <div v-for="produto in produtos" :key="produto.id" class="card">
            <p class="paragrafo_title">Produto N°{{ produto.id }}</p>
          <div class="card-content">
            <p>Nome: {{ produto.nome }}</p>
            <p>Marca: {{ produto.marca }}</p>
            <p>Quantidade: {{ formatValue(produto.quantidade) }}</p>
            <p>Valor: {{ produto.valor }}</p>
          </div>
          <div class="card-buttons">
            <PrimaryButton type="editar">Editar</PrimaryButton>
            <SecondaryButton @click="destroy(produto.id)">Excluir</SecondaryButton>
          </div>
        </div>
      </div>
    </section>

  </AutenticatedLayout>
</template>

<style>

.section-itens{
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 40px;
}

.card-container{
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    width: 80vw;
    gap: 30px;
    margin-bottom: 40px;
    background-color: rgb(236, 241, 240);
}

.paragrafo_title{
    display: flex;
    justify-content: center;
    color: rgb(255, 255, 255);
    padding: 5px;
    margin: 0 auto;
    width: fit-content;
    font-size: 20px;
    background-color: #1D6791;
}


.card{
    display: flex;
    flex-direction: column;
    gap: 40px;
    padding: 20px;
    background-color: rgb(210, 216, 216);
}

.card-content{
    display:grid;
    font-family: Arial, Helvetica, sans-serif;
    gap: 5px;
}

.card-buttons{
    display: flex;
    gap: 10px;
}


.div_criar{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 50px;
}

</style>