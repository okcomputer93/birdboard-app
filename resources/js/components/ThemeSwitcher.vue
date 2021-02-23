<template>
    <div class="mr-8 flex items-center">
        <button
            v-for="(color, theme) in themes"
            class="rounded-full w-4 h-4 border-2 mr-2 focus:outline-none"
            :class="{ 'border-accent': selectedTheme === theme  }"
            :style="{ backgroundColor: color }"
            @click="selectedTheme = theme"
        ></button>
    </div>
</template>

<script>
export default {
    name: "ThemeSwitcher.vue",
    data() {
        return {
            themes: {
                'theme-light': '#f5f6f9',
                'theme-dark': '#222'
            },
            selectedTheme: "theme-dark",
        }
    },
    watch: {
        selectedTheme(newTheme, oldTheme) {
            console.log(newTheme, oldTheme);
            document.body.classList.replace(oldTheme, newTheme);
            localStorage.setItem('theme', newTheme);
        }
    },
    mounted() {
        this.selectedTheme = localStorage.getItem('theme') || "theme-dark";
    }
}
</script>

<style scoped>

</style>

