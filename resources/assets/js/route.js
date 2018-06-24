
import DashboardLayout from './components/Layout/DashboardLayout.vue'
// GeneralViews
import NotFound from './components/NotFoundPage.vue'

// groups_list
import groups_list          from './components/groups_list/main.vue'
import list_search          from './components/groups_list/list_search'
import list_show            from './components/groups_list/list_show'

// make_event
import event_make_main      from './components/group_menu/make_event/event_make_main'
import group_make      from './components/groups_list/group_make'

// group menu tab
import GroupMenuTab         from "./components/group_menu/GroupMenuTab.vue";

// group notice
import NoticeListUp         from "./components/group_menu/group_notice/NoticeListUp.vue";
import NoticeWriteBtn       from './components/group_menu/group_notice/NoticeWriteBtn.vue';


//group event
import plan_main            from './components/group_menu/group_event/plan_main'
import GroupPlanCalendar    from './components/group_menu/group_event/GroupPlanCalendar.vue';



// group member list
import GroupMemberList      from './components/group_menu/group_member/GroupMemberList.vue';
import GroupMemberDetail    from './components/group_menu/group_member/GroupMemberDetail.vue';
// wating member list
import WaitingMemberList     from './components/group_menu/group_member/WaitingMemberList.vue';

// Admin pages
import Record from './components/myRecord/myRecordMain.vue'
import UserProfile from './components/loginAndRegister/UserProfile.vue'
import TableList from './components/myGroup/TableList.vue'
import Notifications from './components/Notifications.vue'


// main
import Main                 from './components/Layout/MainPage.vue'
// import Main from './components/Layout/Main'

const routes = [
    {
        path: '',
        component: DashboardLayout,
        redirect: '',
        children: [
            {
                path: '',
                name: 'Overview',
                component: Main
            },
            {
                path: 'record',
                name: 'Record',
                component: Record,
            },
            {
                path: 'group-list',
                name: 'Group List',
                component: groups_list,
                children: [
                    {
                        path: '',
                        components: {
                            header: list_search,
                            body: list_show,
                            make: group_make
                        }
                    }
                ]
            },
            {
                path: 'user',
                name: 'User',
                component: UserProfile
            },
            {
                path: 'table-list',
                name: 'Table List',
                component: TableList
            },
            {
                path: 'notifications',
                name: 'Notifications',
                component: Notifications
            },
            // group menu
            {
                name        : 'GroupMenu',
                path        : '/group',
                component   : GroupMenuTab,
                children    : [
                    // tab of group menu
                    {
                        path        : ':groupid',
                        components  : {
                            notice      : NoticeListUp,
                            plan        : plan_main,
                            member_list : GroupMemberList,
                        },
                        children: [
                            {
                                path        : '',
                                components  : {
                                    item    : GroupPlanCalendar,
                                    make        : event_make_main,
                                    write   : NoticeWriteBtn,
                                    calendar    : GroupPlanCalendar,
                                    member_detail   : GroupMemberDetail,
                                    waiting_member   : WaitingMemberList,
                                }
                            }
                        ]
                    },

                ]
            }
        ]
    },

    { path: '*', component: NotFound }
]

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * The specified component must be inside the Views folder
 * @param  {string} name  the filename (basename) of the view to load.
 function view(name) {
   var res= require('../components/Dashboard/Views/' + name + '.vue');
   return res;
};**/

export default routes
