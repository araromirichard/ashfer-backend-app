<template>
    <div>
        <input
            type="file"
            class="hidden"
            ref="photoInput"
            @change="updatePhotoPreview"
        />

        <jet-label for="photo" :value="label" />

        <!-- Current Profile Photo -->
        <div class="mt-2" v-show="!photoPreview">
            <img :src="imageUrl" class="rounded-full h-20 w-20 object-cover" />
        </div>

        <!-- New Profile Photo Preview -->
        <div class="mt-2" v-show="photoPreview">
            <span
                class="block rounded-full w-20 h-20"
                :style="
                    'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                    photoPreview +
                    '\');'
                "
            >
            </span>
        </div>

        <jet-secondary-button
            class="mt-2 mr-2"
            type="button"
            @click.native.prevent="selectNewPhoto"
        >
            Select A New Photo
        </jet-secondary-button>

        <jet-input-error :message="errorMessage" class="mt-2" />
    </div>
</template>

<script setup>
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInputError from "@/Jetstream/InputError";
import { ref } from "vue";

const props = defineProps({
    imageUrl: {},
    label: String,
    errorMessage: String,
    modelValue: {
        type: File,
        default: null,
    },
});

const emit = defineEmits(["update:modelValue"]);
const photoPreview = ref(null);
const photoInput = ref(null);

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
    emit("update:modelValue", photoInput.value.files[0]);

    //emit.input(photo);

    console.log(photoPreview.value);
};
</script>
