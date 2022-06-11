<template>
  <validation-observer
    ref="observer"
    v-slot="{ invalid }"
  >
    <form @submit.prevent="submit">
      <validation-provider
        v-slot="{ errors }"
        name="name"
        rules="required|max:50"
      >
        <v-text-field
          v-model="name"
          :counter="10"
          :error-messages="errors"
          label="Name"
          required
        ></v-text-field>
      </validation-provider>
      <validation-provider
        v-slot="{ errors }"
        name="email"
        rules="required|email"
      >
        <v-text-field
          v-model="email"
          :error-messages="errors"
          label="E-mail"
          required
        ></v-text-field>
      </validation-provider>

      <validation-provider
        v-slot="{ errors }"
        name="password"
        rules="required|max:50"
      >
        <v-text-field
          v-model="password"
          :counter="10"
          :error-messages="errors"
          label="Password"
          required
        ></v-text-field>
      </validation-provider>

      <validation-provider
        v-slot="{ errors }"
        name="select"
        rules="required"
      >
        <v-select
          v-model="select"
          :items="items"
          :error-messages="errors"
          label="Select"
          data-vv-name="select"
          required
        ></v-select>
      </validation-provider>

      <v-btn
        class="mr-4"
        type="submit"
        :disabled="invalid"
      >
        submit
      </v-btn>
      <v-btn @click="clear">
        clear
      </v-btn>
    </form>
  </validation-observer>
</template>
<script>

  import { required, digits, email, max, regex } from 'vee-validate/dist/rules'
  import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
  setInteractionMode('eager')
    extend('digits', {
        ...digits,
        message: '{_field_} necesita {length} digitos. ({_value_})',
    })

    extend('required', {
        ...required,
        message: '{_field_} es requerido',
    })

    extend('max', {
        ...max,
        message: '{_field_} no puede tener mas de {length} caracteres',
    })

    extend('regex', {
        ...regex,
        message: '{_field_} {_value_} no coinciden {regex}',
    })

    extend('email', {
        ...email,
        message: 'El email no es valido',
    })

export default {
    components: {
        ValidationProvider,
        ValidationObserver,
    },
    data: () => ({
        name: '',
        email: '',
        password: '',
        select: null,
        items: [
            
        ],
    }),

    methods: {
        submit () {
            this.$refs.observer.validate()
        },
        clear () {
            this.name = ''
            this.email = '' 
            this.password= ''
            this.select = null
            this.$refs.observer.reset()
        },
    },
}
</script>