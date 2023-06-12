<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import sideBarVue from '@/Layouts/sideBar.vue';
import { Head } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout></AuthenticatedLayout>
    <sideBarVue></sideBarVue>
    <div class="index">
        <h1><b>Liste des produits :</b></h1>

        <form @submit.prevent="filterProducts" class="filter-section">
            <div>
                <label for="name">Nom:</label>
                <input type="text" id="name" v-model="filter.name" />
            </div>
            <div>
                <label for="description">Description:</label>
                <input type="text" id="description" v-model="filter.description" />
            </div>
            <div>
                <label for="size">Taille:</label>
                <input type="text" id="size" v-model="filter.size" />
            </div>
            <button type="submit" id="filterBtn">Rechercher</button>
        </form>

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
                <tr v-for="product in filteredProducts" :key="product.id" :id="'product-' + product.id">
                    <td>{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.size }}</td>
                    <td>
                        <button @click="editProduct(product.id)">Modifier</button>
                        <button @click="deleteProduct(product.id)" class="delete">Supprimer</button>
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
        data() {
            return {
                products: [],
                deleteMessage: '',
                filter: {
                    name: '',
                    size: '',
                    description: '',
                },
                filteredProducts: [],
            };
        },

        mounted() {
            this.$nextTick(() => {
                document.getElementById("filterBtn").click();
                console.log("ok");
            });
        },

        methods: {

            editProduct(productId) {
                const editUrl = route('products.edit', { id: productId });
                window.location.href = editUrl;
            },
            fetchProducts() {
                axios.get('/products')
                .then((response) => {
                    this.products = response.data;
                    this.filteredProducts = this.products;
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            filterProducts() {
                axios
                .post('/products/filter', this.filter)
                .then((response) => {
                    this.filteredProducts = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            deleteProduct(productId) {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this product?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                    axios
                        .delete(route('products.destroy', { id: productId }))
                        .then(() => {
                        this.products.splice(
                            this.products.findIndex((product) => product.id === productId),
                            1
                        );
                        const productElement = document.getElementById(`product-${productId}`);
                        if (productElement) {
                            productElement.style.display = 'none'; // Hide the element
                        }
                        Swal.fire('Deleted!', 'The product has been deleted.', 'success');
                        })
                        .catch((error) => {
                        Swal.fire('Error', 'Failed to delete the product.', 'error');
                        });
                    }
                });
            },
        },
    };
</script>

<style>
.index {
    margin-left: 250px;
    padding-top: 5rem;
}

.index h1 {
    font-size: 35px;
    margin-bottom: 20px;
}

.success-message {
    color: green;
    font-weight: bold;
    margin-top: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead th {
    background-color: #f2f2f2;
    padding: 10px;
    font-weight: bold;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

tbody td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

tbody tr:last-child td {
    border-bottom: none;
}

tbody tr:hover {
    background-color: #f5f5f5;
}

button {
    padding: 6px 10px;
    background-color: #4CAF50;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 14px;
}

button:hover {
    background-color: #45a049;
}

button.delete {
    padding: 6px 10px;
    background-color: #ff5252;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 14px;
}

button.delete:hover {
    background-color: #e60000;
}


form.filter-section {
    margin-bottom: 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

form.filter-section div {
    display: flex;
    align-items: center;
}

label {
    margin-right: 5px;
    font-weight: bold;
}

input[type="text"] {
    width: 200px;
    padding: 6px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button[type="submit"] {
    padding: 6px 10px;
    background-color: #4CAF50;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 14px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}
</style> 
