<template>
    <nav class="nav">
      <header class="header">
        <h1 class="h1_title">
          <img class="image_banner" src="../Assets/voxlabs.png" width="50px">
          IGEST
        </h1>
        <nav>
          <ul class="ul_header">
            <a href="/index">Home</a>
            <a href="/produto">Produtos</a>
            <a href="/contato/create">Contatos</a>
          </ul>
        </nav>
      </header>

      <main>
      <slot/>
      </main>

      <footer class="footer">
        <p>&copy; Desenvolvido por Lucas Oliveira</p>
      </footer>
    </nav>
</template>

<style type="text/css">

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
  display: block;
  width: 30vw;
  height: 35px;
  border-radius: 10px;
  margin-left: 10px;
  margin-right: 10px;
}


.h1_title{
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 25px;
  gap: 10px;
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
    background-color: #022B42;
    text-align: center;
    min-width: 100%;
    margin-right: 20px;
    max-width: 100%;
    border: 1px solid black;
    padding: 20px;

}

.ul_header{
    display: flex;
    justify-content: space-between;
    margin-right: 150px;
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
    background-color: #022B42;
    font-size: 20px;
}

.image_banner{
    margin-left: 50px;
}

main {
  min-height: 100vh;
}

@media (max-width: 1000px) {

.ul_header{
    display: block;
    align-items: center;
    overflow: hidden;
    gap: 20px;
    margin-right: 80px;;
}

.pesquisar{
    display: none;
}

.h1_title{
    display: flex;
    justify-content: center;
    width: 200px;
    padding: 5px;
    gap: 1px;
}

.image_banner{
    display: flex;
    padding: 10px;
    margin-right: 10px;
    margin-left: 10px;
    max-width: 60px;
    min-width: 50px;
}


.footer{
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    margin-right: 20px;
    padding: 20px;
}

}

@media (max-width: 546px){

    .h1_title{
        display: flex;
        justify-content: center;
        margin-right: 50px;
    }

    .ul_header {
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow: hidden;
        padding: 10px;
        gap: 1px;
    }

    .ul_header .a {
        display: flex;
        justify-content: center;
        margin: 10px;
    }

    .footer{
        display: flex;
        justify-content: center;
        align-items: center;
    }
}
</style>


