<template>
    <nav class="nav">
      <header class="header">
        <h1 class="h1_title">
          <img class="image_banner"  src="../Assets/voxlabs.png" width="50px">
          iGest
        </h1>
        <div>
          <input placeholder="Pesquisar" class="pesquisar">
        </div>
        <nav>
          <ul class="ul_header">
            <a href="/produto">Produtos</a>
            <a href="/contato/create">Contatos</a>
            <a href="/logout/destroy" @click.prevent="logout">Logout</a>
          </ul>
        </nav>
      </header>
      
      <main>
      <slot/>
      </main>

      <footer class="footer">
        <p class="p_footer">&copy; Desenvolvido por Lucas Oliveira</p>
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
  height: 35px;
  border-radius: 10px;
}


.h1_title{
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 25px;
  gap: 20px;
}

a{
  text-decoration: none;
  color: white;
  transition: color 0.1s ease-in-out;
  padding: 10px;
  position: relative;
  font-size: 20px;
 
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
    font-size: 20px;
}

main {
  min-height: 100vh;
}

@media (max-width: 1000px) {
  .ul_header{
    display: block;
    align-items: center;
    flex-direction: row;
    overflow: hidden;
    margin-right: 20px;
    gap: 10px;
    padding: 2px;
  }

  .image_banner{
    width: 30px;
  }


  .pesquisar{
    display: none;
  }

  .footer{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: row;
    margin: 0 auto;
    margin-right: 20px;
    padding: 20px;
  }

  .p_footer{
    display: flex;
    margin: 0 auto;
    margin-left: 45px;
    margin-right: 80px;
  }

}


</style>

  