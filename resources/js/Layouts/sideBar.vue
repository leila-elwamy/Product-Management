<template>
  <div class="sidebar">
    <ul class="menu">
      <a :href="route('dashboard')">
        <li class="menu-item">La liste</li>
      </a>
      <a :href="route('products.create')">
        <li class="menu-item">Ajouter</li>
      </a>
      <li class="menu-item" v-if="isAdmin"><a href="#">Bouton Administrateur</a></li>
    </ul>
  </div>
</template>
    
<script>
import NavLink from '@/Components/NavLink.vue';
export default {
  data() {
    // return {
    //   isAdmin: false, // Par défaut, l'utilisateur n'est pas un administrateur
    // };
  },
  mounted() {
    // Effectuez une requête ou récupérez les informations de l'utilisateur
    // pour déterminer s'il est un administrateur ou non
    // Mettez à jour la valeur de `isAdmin` en conséquence
    // par exemple, vous pouvez utiliser une méthode `fetchUser()` pour récupérer les données de l'utilisateur
    // this.fetchUser();
  },
  methods: {
    // fetchUser() {
    //   // Effectuez une requête pour récupérer les informations de l'utilisateur
    //   // Assurez-vous de configurer les routes et les contrôleurs appropriés côté serveur
    //   axios.get(route('user.details'))
    //     .then(response => {
    //       const user = response.data;
    //       this.isAdmin = user.is_admin; // Mettez à jour la valeur de `isAdmin` en fonction du rôle de l'utilisateur
    //     })
    //     .catch(error => {
    //       // Gérer les erreurs liées à la récupération des informations de l'utilisateur
    //     });
    // },
  },
};
</script>
    
  
<style>
.sidebar {
  width: 250px;
  height: 100vh;
  background-color: #d0d0d0;
  padding: 20px;
  position: fixed;
  top: 4rem;
}

.menu {
  list-style: none;
  padding: 0;
  margin: 0;
}

.menu-item {
  margin-bottom: 10px;
  padding: 8px;
  background-color: #89CFF0;
  border-radius: 4px;
  cursor: pointer;
  text-align: center;
  color: #fff;
  font-weight: 700;
  font-size: 20px;
}

.menu-item:hover {
  background-color: #5B8AA0;
}

/* .menu-item:first-child {
  margin-top: 0;
}

.menu-item:last-child {
  margin-bottom: 0;
} */
</style>