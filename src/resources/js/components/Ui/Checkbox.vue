<template>
    <label
        :for="name"
        class="uppercase font-bold text-gray-500 text-sm checkbox-wrapper flex flex-row justify-center items-center mr-3"
        :class="{'reversed':reversed }"
    >
        {{ text }}
        <input
            hidden
            type="checkbox"
            :name="name"
            :value="value"
            :checked="inChecked"
        >
        <div
            class="flex flex-row justify-center items-center ml-1 rounded w-4 h-4 border "
            :class="inChecked ? 'bg-red-600' : 'bg-white border-red-600'"
            @click="toggle()"
        >
            <i
                v-if="inChecked"
                class="fas fa-check text-white text-xs"
            ></i>
        </div>
    </label>
</template>

<script>

    export default {

        props: {
            name,
            checked: {
                type: Boolean,
                default: false,
            },
            disabled: {
                type: Boolean,
                default: false
            },
            value: {
                default: '',
            },
            text: {
                default: '',
            },
            reversed: {
                type: Boolean,
                default: false
            },
            redirect: {},
        },

        data() {
            return {
                inChecked: undefined,
            }
        },

        methods: {
            toggle() {
                if (this.redirect) {
                    window.location.href = this.redirect;
                }
                if (!this.disabled) {
                    this.inChecked = !this.inChecked;
                }
            }
        },

        mounted() {
            // mutating props in Vue is anti-pattern
            this.inChecked = this.checked;
        },
    }
</script>

<style lang="scss" scoped>
    // variants
    .reversed {
        position: relative;

        div {
            position: absolute;
            left: -2em;
        }
    }
</style>
