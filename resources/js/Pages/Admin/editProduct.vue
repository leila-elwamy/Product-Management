 <template>
    <div class="edit-product">
      <sideBar></sideBar>
      <div class="content">
        <h2 class="page-title">Edit Product</h2>
  
        <form @submit.prevent="updateProduct" class="form">
          <div class="form-group">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" class="form-control" v-model="form.name" required autofocus />
            <div class="invalid-feedback">{{ form.errors.name }}</div>
          </div>
  
          <div class="form-group">
            <label for="description" class="form-label">Description:</label>
            <input type="text" id="description" class="form-control" v-model="form.description" required />
            <div class="invalid-feedback">{{ form.errors.description }}</div>
          </div>
  
          <div class="form-group">
            <label for="size" class="form-label">Size:</label>
            <input type="text" id="size" class="form-control" v-model="form.size" required />
            <div class="invalid-feedback">{{ form.errors.size }}</div>
          </div>
  
          <div class="form-group">
            <button type="submit" class="btn btn-primary" :disabled="form.processing">Update Product</button>
          </div>
  
          <transition name="fade" mode="out-in">
            <p v-if="form.recentlySuccessful" class="success-message">Product updated.</p>
          </transition>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import { defineProps } from 'vue';
  import { useForm } from '@inertiajs/inertia-vue3';
  // import sideBar from '../layouts/sideBar.vue';
  import sideBar from '@/Layouts/sideBar.vue';
  
  export default {
    components: {
      sideBar,
    },
    props: {
      product: {
        type: Object,
        required: true,
      },
    },
    setup(props) {
      const form = useForm({
        name: props.product.name,
        description: props.product.description,
        size: props.product.size,
      });
  
      const updateProduct = () => {
        form.put(route('products.update', props.product.id), {
          onFinish: () => form.reset(),
        });
      };
  
      return {
        form,
        updateProduct,
      };
    },
  };
  </script>
  
  <style scoped>
  .edit-product {
    display: flex;
  }
  
  .content {
    flex: 1;
    padding: 20px;
  }
  
  .page-title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
  }
  
  .form {
    max-width: 400px;
    margin: 0 auto;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-label {
    font-weight: bold;
  }
  
  .form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  .invalid-feedback {
    color: red;
    margin-top: 5px;
  }
  
  .btn-primary {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .success-message {
    color: #4caf50;
    margin-top: 10px;
  }
  </style>
  