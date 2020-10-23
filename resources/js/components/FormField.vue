<style>
    .emoji-mart-emoji,
    .emoji-mart-emoji > span {
        user-select: none;
        cursor: pointer !important;
    }

    .picker-button:after {
        font-size: 1.5rem;
        display: block;
        content: '🙂';
    }

    .picker-button:hover:after {
        content: '😀';
    }

    .picker-button.picker-button--open:after {
        content: '🤔';
    }

    .picker-button.picker-button--open:hover:after {
        content: '☹️';
    }
</style>

<template>
    <div style="position: relative;">
        <div
            :style="{
                'position': 'absolute',
                'right': '4rem',
                'top': '4rem',
                'z-index' : '10'
            }"
            v-show="open !== false"
        >
            <Picker
                :style="{
                    'border-top-right-radius': '0'
                }"
                @select="selectEmoji"
                native="true"
                ref="picker"
            />
        </div>

        <div
            style="position: relative;"
            v-for="(child, index) in field.fields"
            ref="field"
            :key="index"

        >
            <component
                :is="'form-' + child.component"
                :resource-name="resourceName"
                :resource-id="resourceId"
                :field="child"
                :errors="errors"
                :related-resource-name="relatedResourceName"
                :related-resource-id="relatedResourceId"
                :via-resource="viaResource"
                :via-resource-id="viaResourceId"
                :via-relationship="viaRelationship"
                :show-help-text="showHelpText"
            />
            <button
                class="picker-button"
                :class="{ 'picker-button--open': open === index }"
                style="position: absolute; top: 1.5rem; right: 2rem; padding: 0.5rem;"
                type="button"
                @click="toggle(index)"
            ></button>
        </div>
    </div>
</template>

<script>
    import { FormField, HandlesValidationErrors } from 'laravel-nova'
    import { Picker } from 'emoji-mart-vue'

    export default {
        mixins: [ FormField, HandlesValidationErrors ],

        components: {
            Picker,
        },

        data: () => ({ open: false, height: 0 }),

        props: [
            'field',
            'resourceId',
            'viaResource',
            'resourceName',
            'viaResourceId',
            'viaRelationship',
            'relatedResourceId',
            'relatedResourceName'
        ],

        created: function() {
            window.addEventListener('click', this.windowClick);
        },

        destroyed: function() {
            window.removeEventListener('click', this.windowClick);
        },

        methods: {
            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                for (const field of this.field.fields) {
                    field.fill(formData)
                }
            },
            toggle(index) {
                this.height = this.$refs.field
                    .slice(0, index)
                    .reduce((height, el) => height + el.clientHeight, 0);

                if (this.open === false || this.open !== index) {
                    this.open = index;
                } else {
                    this.open = false;
                    this.height = 0;
                }
            },
            selectEmoji(emoji) {
                if (this.open === false) return;

                // 1. Ask the field to fill a mock FormData so we extract the current value
                let data = new FormData();
                this.field.fields[this.open].fill(data);
                let value = data.get(this.field.fields[this.open].attribute);

                // 2. Add the selected Emoji to it
                value += emoji.native;

                // 3. Update the value
                Nova.$emit(this.field.fields[this.open].attribute + "-value", value);
            },
            windowClick(event) {
                if(
                    ! event.target.classList.contains('picker-button') &&
                    ! this.$refs.picker.$el.contains(event.target) &&
                    this.open !== false
                ) {
                    return this.open = false;
                }
            },
        },
    }

</script>
