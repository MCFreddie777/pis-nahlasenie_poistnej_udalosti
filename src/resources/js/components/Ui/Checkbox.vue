<template>
    <label
        :for="name"
        class="uppercase font-bold text-gray-500 text-sm checkbox-wrapper flex flex-row justify-center items-center mr-3"
        :class="{'reversed':reversed }"
    >
        {{ text }}
        <input
            type="checkbox"
            :name="name"
            :value="value"
        >
        <div
            class="flex flex-row justify-center items-center ml-1 rounded w-4 h-4 border "
            :class="checked ? 'bg-red-600' : 'bg-white border-red-600'"
            @click="toggle()"
        >
            <i
                v-if="checked"
                class="fas fa-check text-white text-xs"
            ></i>
        </div>
    </label>
</template>

<script>

    export default {

        props: ['name', 'checked', 'value', 'text', 'reversed', 'disabled','redirect'],

        methods: {
            toggle() {
                if (this.redirect) {
                    window.location.href = this.redirect;
                }
                if (!this.disabled) {
                    this.checked = !this.checked;
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    // variants
    .reversed {
        position: relative;

        div {
            position: absolute;
            left: -2em;
        }
    }
</style>
