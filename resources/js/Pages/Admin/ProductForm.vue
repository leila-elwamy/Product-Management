<script>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import sideBarVue from '@/Layouts/sideBar.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
  components: {
    GuestLayout,
    InputError,
    InputLabel,
    PrimaryButton,
    TextInput,
    sideBarVue,
    AuthenticatedLayout
  },
  setup() {
    const form = useForm({
      name: '',
      description: '',
      size: '',
    });

    const submit = () => {
      form.post(route('products.store'), {
        onFinish: () => form.reset(),
      });
    };

    return {
      form,
      submit,
    };
  },
};
</script>


<template>
  <AuthenticatedLayout></AuthenticatedLayout>
  <sideBarVue></sideBarVue>
    <GuestLayout>
      <Head title="Ajouter un produit" />

      <form @submit.prevent="submit">
        <div>
          <InputLabel for="name" value="Nom du produit" />

          <TextInput
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
            required
            autofocus
          />

          <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <div class="mt-4">
          <InputLabel for="description" value="Description" />

          <TextInput
            id="description"
            type="text"
            class="mt-1 block w-full"
            v-model="form.description"
            required
          />

          <InputError class="mt-2" :message="form.errors.description" />
        </div>

        <div class="mt-4">
          <InputLabel for="size" value="Taille" />

          <TextInput
            id="size"
            type="text"
            class="mt-1 block w-full"
            v-model="form.size"
            required
          />

          <InputError class="mt-2" :message="form.errors.size" />
        </div>

        <div class="flex items-center justify-end mt-4">
          <PrimaryButton
            class="ml-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Ajouter
          </PrimaryButton>
        </div>
      </form>
    </GuestLayout>
  </template>
