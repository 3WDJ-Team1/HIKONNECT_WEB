
import VTooltip from 'v-tooltip'
// Notifications plugin
import Notifications from 'vue-notifyjs'
// A plugin file where you could register global components used across the app
import GlobalComponents from './globalComponents'
// A plugin file where you could register global directives
import GlobalDirectives from './globalDirectives'
// Sidebar on the right. Used as a local plugin in DashboardLayout.vue
import SideBar from './components/SidebarPlugin/index'
// asset imports
import 'bootstrap/dist/css/bootstrap.css'
import 'vue-notifyjs/themes/default.scss'
import '../sass/css/demo.css'
import '../sass/light-bootstrap-dashboard.scss'

// library auto imports
import 'es6-promise/auto'

/**
 * This is the main Light Bootstrap Dashboard Vue plugin where dashboard related plugins are registerd.
 */
export default {
  install (Vue) {
    Vue.use(GlobalComponents)
    Vue.use(GlobalDirectives)
    Vue.use(SideBar)
    Vue.use(Notifications)
    Vue.use(VTooltip)
  }
}
