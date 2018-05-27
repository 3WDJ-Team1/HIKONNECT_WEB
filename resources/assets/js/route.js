
import DashboardLayout from './components/Layout/DashboardLayout.vue'
// GeneralViews
import NotFound from './components/NotFoundPage.vue'

// groups_list
import groups_list          from './components/groups_list/main.vue'
import list_search          from './components/groups_list/list_search'
import list_show            from './components/groups_list/list_show'

// make_event
import autocomplete         from './components/group_menu/make_event/autocomplete'
import event_make_main      from './components/group_menu/make_event/event_make_main'
import event_map            from './components/group_menu/make_event/event_map'
import group_make      from './components/groups_list/group_make'


// group menu tab
import GroupMenuTab         from "./components/group_menu/GroupMenuTab.vue";

// group notice
import NoticeListUp         from "./components/group_menu/group_notice/NoticeListUp.vue";
import NoticeWriteBtn       from './components/group_menu/group_notice/NoticeWriteBtn.vue';
import NoticeModifyBtn      from './components/group_menu/group_notice/NoticeModifyBtn.vue';
import NoticeDeleteBtn      from './components/group_menu/group_notice/NoticeDeleteBtn.vue';
import NoticeFormInside     from './components/group_menu/group_notice/NoticeFormInside.vue';


//group event
import plan_main            from './components/group_menu/group_event/plan_main'
import GroupPlanCalendar    from './components/group_menu/group_event/GroupPlanCalendar.vue';


// group plan
import GroupPlan            from './components/group_menu/group_plan/GroupPlan.vue';

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
import Main                 from './components/main/MainPage.vue'


const routes = [
    {
        path: '/admin',
        component: DashboardLayout,
        redirect: '/admin/overview',
        children: [
            {
                path: 'overview',
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
                                    // write, modify, delete button of NoticeListUp
                                    write   : NoticeWriteBtn,
                                    modify  : NoticeModifyBtn,
                                    delete  : NoticeDeleteBtn,
                                    // components in GroupPlan
                                    calendar    : GroupPlanCalendar,
                                    // component in GroupMemberList
                                    member_detail   : GroupMemberDetail,
                                    waiting_member   : WaitingMemberList,
                                },
                                children: [
                                    {
                                        path        : '',
                                        components  : {
                                            // inner form component of modal(NoticeWriteBtn, NoticeModifyBtn)
                                            form            : NoticeFormInside,
                                            autocomplete    : autocomplete
                                        },
                                        children:   [
                                            {
                                                path: '',
                                                components: {
                                                    map: event_map,
                                                }
                                            }
                                        ]
                                    }
                                ]
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
