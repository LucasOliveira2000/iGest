<script setup>
import PrimaryButton from '../../Components/PrimaryButton.vue'
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
  nome:         props.produtos.nome ,
  marca:        props.produtos.marca ,
  quantidade:   props.produtos.quantidade ,
  valor:        props.produtos.valor,
  imagem:       props.produtos.imagem
});

function handleFileChange(event) {
    form.imagem = event.target.files[0];
    form.imagePreview = form.imagem ? URL.createObjectURL(form.imagem) : null;
}

function submit(){
  if(form.nome && form.marca && form.quantidade && form.valor){
      router.post('/store', form)
  }else{
    toast.error("Verifique todos os campos",{
      position: "top-center",
      theme: 'colored',
      autoClose: 2000,
    });
  }
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
                  <input class="input_produto" id="nome" type="text" v-model="form.nome" required>
                  <span v-if="errors.nome" class="error">{{ errors.nome }}</span>
              </div>
              <div class="form-group">
                  <label for="marca">Marca:</label>
                  <input class="input_produto" id="marca" type="text" v-model="form.marca">
                  <span v-if="errors.marca" class="error">{{ errors.marca }}</span>
              </div>
              <div class="form-group">
                  <label for="quantidade">Quantidade:</label>
                  <input class="input_produto" id="quantidade" type="number" v-model.number="form.quantidade" required>
                  <span v-if="errors.quantidade" class="error">{{ errors.quantidade }}</span>
              </div>
              <div class="form-group">
                  <label for="valor">Valor:</label>
                  <input class="input_produto" id="valor" type="text" v-model="form.valor" required>
                  <span v-if="errors.valor" class="error">{{ errors.valor }}</span>
              </div>
              <div class="form-group">
                  <label for="imagem">Imagem :</label>
                  <input @change="handleFileChange" type="file" id="imagem" class="form-control" accept="imagem/gif, imagem/jpeg, imagem/png">
                  <span v-if="errors && errors.imagem" class="error">{{ errors.imagem }}</span>
                  <div  v-if="form.imagem">
                      <img :src="form.imagePreview" class="imagem" width="120" height="100"/>
                  </div>
              </div>
              <div class="button-group">
                  <PrimaryButton  class="submit">Enviar</PrimaryButton>
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
    border-radius: 60px 60px;
}

.form {
  width: 350px;
  margin-bottom: 20px;
  margin-top: 10px;
  border: 1px solid rgb(29, 103, 145);
  background-color: white;
  border-radius: 5px 60px;
  box-shadow: 2px 2px 25px 2px #006DA4;
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

.notification-message {
    color: green; /* Cor da mensagem */
    font-size: 14px; /* Tamanho da fonte */
    margin-top: 10px; /* Espaçamento superior */
}

.error {
  color: red; /* Cor vermelha para destacar o erro */
  font-size: 0.8rem; /* Tamanho da fonte menor para as mensagens de erro */
  margin-top: 0.2rem; /* Margem superior pequena para separar do campo de entrada */
}

.imagem{
  display: flex;
  margin: 0 auto;
  margin-top: 10px;
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
