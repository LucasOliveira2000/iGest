<script setup>
import PrimaryButton from '../../Components/PrimaryButton.vue';
import Autenticated from '../../Components/AutenticatedLayout.vue';

</script>


<template>
    <Autenticated>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
        </head>

        <section class="section_1">
            <form class="form.login">
                
                <div class="h1_div">
                    <h1>Login</h1>
                </div>
                
                <div class="login_nome">
                    <label for="usuario">Usuário:</label><br>
                    <input class="input_login" placeholder="Digite seu email" type="text" id="usuario" name="usuario"><br>
                </div>
                
                <div class="login_senha">
                    <label for="password">Senha: </label><br>
                    <input class="input_login" placeholder="Digite sua senha" type="password" id="senha" name="senha"><br>
                    <a href="/user/create" class="registro">Se cadastre aqui!</a>
                    <PrimaryButton>Logar</PrimaryButton>
                </div>
            </form>
        </section>
    </Autenticated>

</template>

<style>

.section_1{
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
    margin-top: 25vh;
    background-color: #ccc;
    border: 1px solid black;
    border-radius: 5rem;
    width: 30rem;
}

.h1_div{
   display: flex;
   justify-content: center;
   align-items: center;
   margin-bottom: 20px;
   font-family: Arial, Helvetica, sans-serif;
   font-size: 25px;
   color: white;
   text-shadow: 3px 0px 7px rgba(0, 0, 0, 0.8), -3px 0px 7px rgba(219, 198, 198, 0.8), 0px 4px 7px rgba(0, 0, 0, 0.8);
}


.login_nome {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    margin-top: 5vh;
    color: white;
    text-shadow: 3px 0px 7px rgba(0, 0, 0, 0.8), -3px 0px 7px rgba(0, 0, 0, 0.8), 0px 4px 7px rgba(0, 0, 0, 0.8);
}

.login_senha {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: white;
    text-shadow: 3px 0px 7px rgba(0, 0, 0, 0.8), -3px 0px 7px rgba(0, 0, 0, 0.8), 0px 4px 7px rgba(0, 0, 0, 0.8);
}

.input_login{
    display: flex;
    position: relative;
    text-align: center;
    height: 25px;
    border-radius: 20px;
    color: black;
    

}

.registro{
    margin-right: 30px;
    margin-bottom: 10px;
    font-size: 16px;
}

.registro:hover{
    color: rgb(0, 0, 0);
}

</style>