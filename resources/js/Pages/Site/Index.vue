<script setup type="text/js">
import AutenticatedLayout from '../../Components/AutenticatedLayout.vue';

</script>

<template>
    <head>
        <title>Home</title>
    </head>
    <section>
        <AutenticatedLayout>
            <section>
                <div class="div_banner">
                    <img src="./../../Assets/banner.png">
                </div>

                <div class="div_h1_title">
                    <h1 class="title_principal">Por que utilizar os nosso serviços?</h1>
                </div>

                <div class="div_cards">
                    <div class="div_unit_card">
                        <h2 class="h2">Organização</h2>
                        <div class="imagem">
                            <img src="../../Assets/estoque.png" width="250px" >
                        </div>
                        <p class="paragrafo"><i>Organize seu estoque com facilidade</i></p>
                    </div>

                    <div class="div_unit_card">
                        <h2 class="h2">Controle</h2>
                        <div class="imagem">
                            <img src="../../Assets/estoque2.png" width="250px" >
                        </div>
                        <p class="paragrafo"><i>Tenha total controle sobre o seu estoque</i></p>
                    </div>

                    <div class="div_unit_card">
                        <h2 class="h2">Agilidade</h2>
                        <div class="imagem">
                            <img src="../../Assets/estoque3.jpg" width="250px" >
                        </div>

                        <p class="paragrafo"><i>Economize tempo na procura de um produto</i></p>
                    </div>

                    <div class="div_unit_card">
                        <h2 class="h2">Financeiro</h2>
                        <div class="imagem">
                            <img src="../../Assets/estoque4.jpg" width="250px" >
                        </div>
                        <p class="paragrafo"><i>Reduza sua perca de dinheiro mensal/anual</i></p>
                    </div>

                    <div class="div_unit_card">
                        <h2 class="h2">Localização</h2>
                        <div class="imagem">
                            <img src="../../Assets/controle.png" width="250px" >
                        </div>
                        <p class="paragrafo"><i>Localização completa</i></p>
                    </div>

                    <div class="div_unit_card">
                        <h2 class="h2">Verificação</h2>
                        <div class="imagem">
                            <img src="../../Assets/estoque6.png" width="250px" >
                        </div>
                        <p class="paragrafo"><i>Controle de quantidade e inatividade</i></p>
                    </div>

                </div>
            </section>
        </AutenticatedLayout>
    </section>
</template>


<style type="text/css">

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
    background-color: #022B42;
    padding: 20px;
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
    display: block;
    box-shadow: 4px 4px rgb(29, 103, 145);
}

.h2{
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px;
    color: rgb(255, 255, 255);
    background-color: #022B42;
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
    justify-content: center;
    color: black;
    font-family: Arial, Helvetica, sans-serif;
    justify-content: center;
    margin: 0 auto;
    height: 50px;
    max-width: 200px;
    margin-top: 15px;
    font-size: 15px;

}

@media (max-width: 500px) {

    .div_h1_title{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
    }

    .title_principal{
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        margin: 0 auto;
        margin-right: 25px;
        width: 500px;
    }
}



</style>
