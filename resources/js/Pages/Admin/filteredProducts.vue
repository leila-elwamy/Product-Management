<template>
    <div>
      <h1>Résultats de la recherche</h1>

      <table>
        <thead>
          <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Taille</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in filteredProducts" :key="product.id">
            <td>{{ product.name }}</td>
            <td>{{ product.description }}</td>
            <td>{{ product.size }}</td>
            <td>
              <button @click="editProduct(product.id)">Modifier</button>
              <button @click="deleteProduct(product.id)">Supprimer</button>
            </td>
          </tr>
        </tbody>
      </table>

      <div v-if="deleteMessage" class="success-message">
        {{ deleteMessage }}
      </div>
    </div>
  </template>

  <script>
  export default {
    props: {
      filteredProducts: Array,
    },

    data() {
      return {
        deleteMessage: '',
      };
    },

    methods: {
      editProduct(productId) {
        const editUrl = route('products.edit', { id: productId });
        window.location.href = editUrl;
      },

      deleteProduct(productId) {
        axios
          .delete(route('products.destroy', { id: productId }))
          .then(() => {
            this.filteredProducts.splice(
              this.filteredProducts.findIndex(product => product.id === productId),
              1
            );
            this.deleteMessage = 'Produit supprimé avec succès';
          })
          .catch(error => {
            // Gérer les erreurs liées à la suppression du produit
          });
      },
    },
  };
  </script>

  <style>
  .success-message {
    color: green;
    font-weight: bold;
    margin-top: 10px;
  }
  </style>
