<template>
    <nav class="nav">
      <header class="header">
        <h1 class="h1_title">
          <img src="../Assets/voxlabs.png" width="50px">
          iGest
        </h1>
        <div>
          <input placeholder="Pesquisar" class="pesquisar">
        </div>
        <nav>
          <ul class="ul_header">
            <a href="/index">Home</a>
            <a href="/produto">Produtos</a>
            <a href="/create">Contatos</a>
            <a @click="logout">Logout</a>
            <a href="/login">Login</a>
          </ul>
        </nav>
      </header>
      
      <main>
      <slot/>
      </main>
  
      <footer class="footer">
        <p> Desenvolvido por Lucas Oliveira</p>
      </footer>
    </nav>
</template>
  
<script setup>
import { router } from '@inertiajs/vue3';

  
function logout(){

  router.post('/logout/destroy');
}




</script>
  

<style >

*{
    margin: 0px;
    padding: 0px;
    overflow-x: hidden;
}

.nav {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}


.pesquisar{
  display: flex;
  width: 50vh;
  height: 30px;
  border-radius: 10px;
}


.h1_title{
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
}

a{
  text-decoration: none;
  color: white;
  transition: color 0.1s ease-in-out;
  padding: 10px;
  position: relative;
 
}

a:after{
  content: '';
  position: absolute;
  width: 100%;
  height: 2px;
  bottom: 0;
  left: 0;
  background-color: #ffffff;
  visibility: hidden;
  transform: scaleX(0);
  transition: all 0.3s ease-in-out;
}

a:hover:after, a.active:after{
  visibility: visible;
  transform: scaleX(1);
}

.header {
    display: flex;
    align-items: center;
    justify-content:space-between;
    color: #fff;
    background-color: #1D6791;
    text-align: center;
    min-width: 100%;
    max-width: 100%;
    border: 1px solid black;
    padding: 20px;
    text-shadow: 3px 0px 7px rgba(0, 0, 0, 0.8), -3px 0px 7px rgba(0, 0, 0, 0.8), 0px 4px 7px rgba(0, 0, 0, 0.8);
}

.ul_header{
    display: flex;
    justify-content: space-between;
    margin-right: 100px;
    gap: 30px;
}

.footer{
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    bottom: 0;
    position: relative;
    width: 100%;
    padding: 20px;
    background-color: #1D6791;
}

main {
  min-height: 100vh;
}




</style>

  