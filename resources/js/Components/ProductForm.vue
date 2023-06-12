<template>
    <div>
        <form @submit.prevent="addProduct">
            <div>
                <label for="name">Nom :</label>
                <input type="text" id="name" v-model="product.name" required>
            </div>

            <div>
                <label for="description">Description :</label>
                <textarea id="description" v-model="product.description" required></textarea>
            </div>

            <div>
                <label for="size">Taille :</label>
                <input type="text" id="size" v-model="product.size" required>
            </div>

            <button type="submit">Ajouter</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                product: {
                    name: '',
                    description: '',
                    size: ''
                }
            };
        },
        methods: {
            addProduct() {
                axios.post('/products', this.product)
                    .then(response => {
                        // Gérer la réponse du serveur après l'ajout du produit
                    })
                    .catch(error => {
                        // Gérer les erreurs
                    });
            }
        }
    };
</script>
