import { Link } from "@inertiajs/inertia-vue3";

export default await (async() => {
    const __VLS_Component = (await
        import ('vue')).defineComponent({
        setup() {
            () => {
                // @ts-ignore
                [Link, ];
                // @ts-ignore
                [items];
            };
            return {};
        },
    });
    const __VLS_slots = (await
        import ('./Breadcrumbs.vue.__VLS_template')).default;
    return {}
    as typeof __VLS_Component & (new() => { $slots: typeof __VLS_slots; });
})();