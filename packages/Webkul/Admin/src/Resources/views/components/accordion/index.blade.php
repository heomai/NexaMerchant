@props([
    'isActive' => true,
])

<<<<<<< HEAD
<v-accordion
    is-active="{{ $isActive }}"
    {{ $attributes }}
>
    <x-admin::shimmer.accordion class="w-[360px] h-[271px]"></x-admin::shimmer.accordion>

    @isset($header)
        <template v-slot:header>
            {{ $header }}
        </template>
    @endisset

    @isset($content)
        <template v-slot:content>
            <div>
                {{ $content }}
            </div>
        </template>
    @endisset
</v-accordion>

@pushOnce('scripts')
    <script type="text/x-template" id="v-accordion-template">
        <div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-900 rounded-[4px] box-shadow']) }}>
            <div :class="`flex items-center justify-between p-[6px] ${isOpen ? 'active' : ''}`">
                <slot name="header">
                    Default Header
                </slot>

                <span 
                    :class="`text-[24px] p-[6px] rounded-[6px] cursor-pointer transition-all hover:bg-gray-100 dark:hover:bg-gray-950 ${isOpen ? 'icon-arrow-up' : 'icon-arrow-down'}`"
                    @click="toggle"
                ></span>
            </div>

            <div class="px-[16px] pb-[16px]" v-if="isOpen">
                <slot name="content">
                    Default Content
                </slot>
            </div>
=======
<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-900 rounded box-shadow']) }}>
    <v-accordion
        is-active="{{ $isActive }}"
        {{ $attributes }}
    >
        <x-admin::shimmer.accordion class="w-[360px] h-[271px]"></x-admin::shimmer.accordion>

        @isset($header)
            <template v-slot:header="{ toggle, isOpen }">
                <div {{ $header->attributes->merge(['class' => 'flex items-center justify-between p-1.5']) }}>
                    {{ $header }}

                    <span
                        :class="`text-2xl p-1.5 rounded-md cursor-pointer transition-all hover:bg-gray-100 dark:hover:bg-gray-950 ${isOpen ? 'icon-arrow-up' : 'icon-arrow-down'}`"
                        @click="toggle"
                    ></span>
                </div>
            </template>
        @endisset

        @isset($content)
            <template v-slot:content="{ isOpen }">
                <div
                    {{ $content->attributes->merge(['class' => 'px-4 pb-4']) }}
                    v-show="isOpen"
                >
                    {{ $content }}
                </div>
            </template>
        @endisset
    </v-accordion>
</div>

@pushOnce('scripts')
    <script type="text/x-template" id="v-accordion-template">
        <div>
            <slot
                name="header"
                :toggle="toggle"
                :isOpen="isOpen"
            >
                Default Header
            </slot>

            <slot
                name="content"
                :isOpen="isOpen"
            >
                Default Content
            </slot>
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
        </div>
    </script>

    <script type="module">
        app.component('v-accordion', {
            template: '#v-accordion-template',

            props: [
                'isActive',
            ],

            data() {
                return {
                    isOpen: this.isActive,
                };
            },

            methods: {
                toggle() {
                    this.isOpen = ! this.isOpen;

                    this.$emit('toggle', { isActive: this.isOpen });
                },
            },
        });
    </script>
@endPushOnce
