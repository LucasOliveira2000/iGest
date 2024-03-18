<script setup>
import SecondLayout from '../../Components/SecondLayout.vue';

</script>

<template>
    <head>
        <title>Home</title>
    </head>
    <section>
        <SecondLayout>

            <section>
                <div class="div_banner">
                    <img src="./../../Assets/banner.png">
                </div>

                <div class="div_h1_title">
                    <h1>Por que utilizar os nosso serviços?</h1>
                </div>
                
                <div class="div_cards">
                    <div class="div_unit_card">
                        <h2 class="h2">Controle</h2>
                        <div class="imagem">
                            <img src="../../Assets/estoque.png" width="250px" >
                        </div>
                        <p class="paragrafo">Comentario da foto 1</p>
                    </div>

                    <div class="div_unit_card">
                        <h2 class="h2">Titulo 2</h2>
                        <div class="imagem">
                            <img src="../../Assets/estoque2.png" width="250px" >
                        </div>
                        <p class="paragrafo">Comentario da foto 2</p>
                    </div>

                    <div class="div_unit_card">
                        <h2 class="h2">Titulo 3</h2>
                        <div class="imagem">
                            <img src="../../Assets/estoque3.jpg" width="250px" >
                        </div>
                      
                        <p class="paragrafo">Comentario da foto 3</p>
                    </div>

                    <div class="div_unit_card">
                        <h2 class="h2">Titulo 4</h2>
                        <div class="imagem">
                            <img src="../../Assets/estoque4.jpg" width="250px" >
                        </div>
                        <p class="paragrafo">Comentario da foto 4</p>
                    </div>

                    <div class="div_unit_card">
                        <h2 class="h2">Titulo 5</h2>
                        <div class="imagem">
                            <img src="../../Assets/controle.png" width="250px" >
                        </div>
                        <p class="paragrafo">Comentario da foto 5</p>
                    </div>

                    <div class="div_unit_card">
                        <h2 class="h2">Titulo 6</h2>
                        <div class="imagem">
                            <img src="../../Assets/estoque6.png" width="250px" >
                        </div>
                        <p class="paragrafo">Comentario da foto 6</p>
                    </div>

                </div>
                
            </section>
        </SecondLayout>
    </section>
</template>


<style>

.div_banner{
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    margin-top: 20px;
    width: 130vh;
    max-width: 100%;

}

.div_h1_title{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
    font-size: 30px;
    font-family: Arial, Helvetica, sans-serif;
    color: white;
    min-width: 100%;
    max-width: 100%;
    background-color: #1D6791 ;
    padding: 20px;
    text-shadow: 3px 0px 7px rgba(0, 0, 0, 0.8), -3px 0px 7px rgba(0, 0, 0, 0.8), 0px 4px 7px rgba(0, 0, 0, 0.8);
}

.div_cards{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: row;
    flex-wrap: wrap;
    overflow-x: auto;
    margin-top: 20px;
    margin-bottom: 20px;
    padding: 30px;
    gap: 20px;

}

.div_unit_card{
    margin-left: 10px;
    height: 250px;
    max-height: 374px;
    padding: 60px;
    border: 2px solid black;
    display: block;
}

.h2{
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px;
    color: rgb(0, 0, 0);
    background-color: #1D6791;
    border-radius: 20px;
    font-family: Arial, Helvetica, sans-serif;
    margin-bottom: 20px;
    gap: 30px;
}


.imagem {
    max-width: 100%;/* Define a largura máxima da imagem como 100% do contêiner */
    height: 139px;
    max-height: 139px; /* Mantém a proporção da imagem */
    display: flex; /* Garante que a imagem respeite as margens */
}

.paragrafo{
    display: flex;
    font-family: Arial, Helvetica, sans-serif;
    justify-content: center;
    max-width: 200px;
    margin-top: 10px;
    font-size: 15px;

}

</style>