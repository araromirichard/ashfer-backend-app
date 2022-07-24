<template>
    <ckeditor :editor="editor" v-model="text" :config="editorConfig"></ckeditor>
</template>

<!-- <script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  props: {
    value: {},
  },
  data() {
    return {
      text: "",
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the editor.
      },
    };
  },
  watch: {
    value: {
      immediate: true,
      handler(value) {
        this.text = value;
      },
    },
    text(text) {
      this.$emit("input", text);
    },
  },
};
</script> -->

<script setup>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

import { ref, watch } from "vue";

const props = defineProps({
    value: {},
});

const emit = defineEmits({
    input: {
        type: String,
        default: "",
    },
});
const text = ref("");
const editor = ClassicEditor;
//const ckeditor = CKEditor.component;

const editorConfig = {
    // The configuration of the editor.
};

watch(
    () => text.value,
    (newValue) => {
        text.value = newValue;
    },
    { immediate: true },
    emit("input", text.value)
);
</script>

<style lang="scss" scoped></style>
