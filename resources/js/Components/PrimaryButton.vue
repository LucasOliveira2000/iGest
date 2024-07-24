<template>
    <button
        class="custom-button">
        <slot />
    </button>

</template>


<style scoped>
.custom-button {
    background-color: #1D6791;
    color: #fff;
    border: none;
    width: 100px;
    border-radius: 4px;
    padding: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.custom-button:hover {
    background-color: #06ec71;
}
</style>
