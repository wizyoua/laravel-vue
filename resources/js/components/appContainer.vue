<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
    >
      <v-list dense>
          <v-list-item link>
              <v-list-item-action>
                  <v-icon>mdi-home</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                  <v-list-item-title>
                      Home
                  </v-list-item-title>
              </v-list-item-content>
          </v-list-item>
      </v-list>
      <v-list dense>
          <v-list-item link>
              <v-list-item-action>
                  <v-icon>mdi-contact-mail</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                  <v-list-item-title>
                      Contact
                  </v-list-item-title>
              </v-list-item-content>
          </v-list-item>
      </v-list>
      <v-list dense>
          <v-list-item link @click="logout">
              <v-list-item-action>
                  <v-icon>mdi-power</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                  <v-list-item-title>
                      Log out {{  currentUser.first }}
                  </v-list-item-title>
              </v-list-item-content>
          </v-list-item>
      </v-list>

    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title>Application</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <!--  -->
    </v-main>
    <v-footer>
        <span class="white-text">&copy; 2021</span>
    </v-footer>
  </v-app>
</template>

<script>
  export default {
    data: () => ({ drawer: null }),
    computed: {
        loggedIn: {
            get() {
                return this.$store.state.currentUser.loggedIn;
            }
        },
        currentUser : {
            get() {
                return this.$store.state.currentUser.user;
            }
        }
    },
    methods: {
        logout(){
            this.$store.dispatch('currentUser/logoutUser');
        },
    },
    created() {
        if(localStorage.hasOwnProperty("blog_token")){
            axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("blog_token");
            this.$store.dispatch('currentUser/getUser');
        }else {
            window.location.replace("/login");
        }
        
    }
  }
</script>