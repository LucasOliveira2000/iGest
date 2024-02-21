<script setup>
import AutenticatedLayout from '../../Components/AutenticatedLayout.vue';




</script>

<template>
    <head>
        <title>Home</title>
    </head>
    <section>
        <AutenticatedLayout>
            <section>
                <div class="div_title">
                    <h1>Bem vindo ao nosso site</h1>
                </div>
            </section>
        </AutenticatedLayout>
    </section>

</template>


<style>

.div_title{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 40px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 20px;

}

</style>