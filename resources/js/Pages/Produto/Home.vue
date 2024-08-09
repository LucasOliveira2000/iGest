<template>
    <SecondLayout>
      <head>
        <title>{{ title }}</title>
      </head>
      <div class="div_criar">
          <PrimaryButton @click="create">Cadastrar</PrimaryButton>
      </div>

      <section class="section-itens">
        <div class="card-container">
          <div v-for="produto in produtos.data" :key="produto.id" class="card">
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
              <TertiaryButton>Visualizar</TertiaryButton>
              <SecondaryButton @click="() => confirmDelete(produto.id)">Excluir</SecondaryButton>
            </div>
          </div>
          </div>
        </div>
      </section>

      <div v-if="produtos.links.length > 1" class="pagination">
        <button
          v-for="(link, index) in produtos.links"
          :key="index"
          :disabled="!link.url"
          @click="fetchPage(link.url)"
          class="pagination-button"
          v-html="link.label"
        ></button>
      </div>

      <div v-if="showConfirm" class="confirm-modal">
        <div class="modal-content">
          <p>Você tem certeza que deseja excluir este produto?</p>
          <PrimaryButton @click="destroyConfirmed">Sim</PrimaryButton>
          <SecondaryButton @click="cancelDelete">Não</SecondaryButton>
        </div>
      </div>
    </SecondLayout>
  </template>

  <script setup>
  import PrimaryButton from '../../Components/PrimaryButton.vue';
  import SecondLayout from '../../Components/SecondLayout.vue';
  import SecondaryButton from '../../Components/SecondaryButton.vue';
  import TertiaryButton from '../../Components/TertiaryButton.vue';
  import { router } from '@inertiajs/vue3';
  import { Flip, toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';  // Importando o CSS do vue3-toastify
  import { watch, nextTick, defineProps } from 'vue';
  import { ref } from 'vue';

  const props = defineProps({
      title: String,
      produtos: Object,
      flash: Object
  });

  const showConfirm = ref(false);
  const confirmCallback = ref(null);
  const produtoIdToDelete = ref(null);

  function confirmDelete(id) {
      produtoIdToDelete.value = id;
      showConfirm.value = true;
      confirmCallback.value = () => destroy(id);  // Define a função de callback com o ID do produto
  }

  function destroyConfirmed() {
      showConfirm.value = false;
      if (confirmCallback.value) {
          confirmCallback.value();
      }
  }

  function cancelDelete() {
      showConfirm.value = false;
  }

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

  function create() {
      router.get('/create');
  }

  function edit(id) {
      router.get(`/produto/edit/${id}`);
  }

  function destroy(id) {
      router.delete(`/produto/${id}`);
  }

  function search(){
      router.get('/produto/search', filtro);
  }

  function fetchPage(url) {
      router.get(url);
  }
  </script>

  <style type="text/css">
  .confirm-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }

  .modal-content {
    background: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    border-radius: 5px 60px;
    box-shadow: 2px 2px 25px 2px #006DA4;
  }

  .modal-content p {
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 20px;
    color: black;
    box-shadow: 4px 4px rgb(29, 103, 145);
  }

  .modal-content button {
    margin: 10px;
    margin-top: 45px;
  }

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
    background-color: white;
    width: 210px;
    margin: 2vh;
    border-radius: 5px 60px;
    box-shadow: 2px 2px 25px 2px #006DA4;
  }

  .card-content {
    display: grid;
    font-family: Arial, Helvetica, sans-serif;
    gap: 10px;
  }

  .card-buttons {
    display:flex;
    margin-top: 10px;
    gap: 5px;
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

  .success {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }

  .pagination {
    display: flex;
    justify-content: center;
    margin-top: 10px;
    margin-bottom: 50px;
    gap: 10px;
  }

  .pagination-button {
    background-color: #006DA4;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .pagination-button.disabled {
    background-color: #c0c0c0;
    cursor: not-allowed;
  }

  .pagination-button:not(.disabled):hover {
    background-color: #004e7a;
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
