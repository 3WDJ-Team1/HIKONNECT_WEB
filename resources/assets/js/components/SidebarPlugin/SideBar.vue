
<template>
  <div class="sidebar"
       :style="sidebarStyle"
       :data-color="backgroundColor"
       :data-image="backgroundImage">
    <div class="sidebar-wrapper">
      <div class="logo" style="text-align: center;">
        <img width="200" style="padding-top: 15px; padding-bottom: 15px;" src="http://hikonnect.ga/images/logo.png" alt="" @click="moveHome">
      </div>
      <slot name="content"></slot>
      <ul class="nav" style="margin: 0;">
        <slot>
          <sidebar-link v-for="(link,index) in sidebarLinks"
                        :key="link.name + index"
                        :to="link.path"
                        @click="closeNavbar"
                        :link="link">
            <i :class="link.icon"></i>
            <p>{{link.name}}</p>
          </sidebar-link>
        </slot>
      </ul>
    </div>
  </div>
</template>
<script>
  export default {
      data()  {
          return  {
              login: sessionStorage.getItem('userid') != undefined,
              httpAddr: Laravel.host,
          }
      },
    props: {
      title: {
        type: String,
        default: 'HIKONNECT'
      },
      backgroundColor: {
        type: String,
        default: 'black',
        validator: (value) => {
          let acceptedValues = ['', 'blue', 'azure', 'green', 'orange', 'red', 'purple', 'black']
          return acceptedValues.indexOf(value) !== -1
        }
      },
      backgroundImage: {
        type: String,
        default: 'http://hikonnect.ga/images/sidebar-5.jpg'
      },
      activeColor: {
        type: String,
        default: 'success',
        validator: (value) => {
          let acceptedValues = ['primary', 'info', 'success', 'warning', 'danger']
          return acceptedValues.indexOf(value) !== -1
        }
      },
      sidebarLinks: {
        type: Array,
        default: () => []
      },
      autoClose: {
        type: Boolean,
        default: true
      }
    },
    provide () {
      return {
        autoClose: this.autoClose
      }
    },
      methods:  {
          moveHome()  {
              this.$router.push("/")
          }
      },
    computed: {
      sidebarStyle () {
        return {
          width: `15%`
        }
      }
    }
  }

</script>
<style>

</style>
