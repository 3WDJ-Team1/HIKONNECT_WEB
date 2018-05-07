import DashboardLayout from './components/Layout/DashboardLayout.vue'
// GeneralViews
import NotFound from './components/NotFoundPage.vue'

// groups_list
import groups_list          from './components/groups_list/main.vue'
import list_search          from './components/groups_list/list_search'
import list_show            from './components/groups_list/list_show'

// group_make
import autocomplete         from './components/group_make/autocomplete'
import event_make_main      from './components/group_make/group_make_main'
import event_map            from './components/group_make/group_map'
import group_make      from './components/group_make/group_make'

// group_update
import group_upadate        from './components/group_make/updateGroup'

// notice
import notice               from './components/notice/main'
import notice_information   from './components/notice/notice_information'

import profile               from './components/mypage/profile.vue';
import modify               from './components/mypage/modify.vue';
import graph                from './components/mypage/graph.vue';
import update                from './components/mypage/update.vue';
import level                from  './components/mypage/level.vue';
import myPage               from './components/mypage/mypagemain'

// group menu tab
import GroupMenuTab         from "./components/group_menu/GroupMenuTab.vue";

// group notice
import NoticeListUp         from "./components/group_menu/group_notice/NoticeListUp.vue";
import NoticeWriteBtn       from './components/group_menu/group_notice/NoticeWriteBtn.vue';
import NoticeModifyBtn      from './components/group_menu/group_notice/NoticeModifyBtn.vue';
import NoticeDeleteBtn      from './components/group_menu/group_notice/NoticeDeleteBtn.vue';
import NoticeFormInside     from './components/group_menu/group_notice/NoticeFormInside.vue';


//group event
import makeEvent            from './components/group_menu/group_event/makeEvent'
import plan_main            from './components/group_menu/group_event/plan_main'
import GroupPlanCalendar    from './components/group_menu/group_event/GroupPlanCalendar.vue';


// group plan
import GroupPlan            from './components/group_menu/group_plan/GroupPlan.vue';
import GroupPlanMap         from './components/group_menu/group_plan/GroupPlanMap.vue';

// group member list
import GroupMemberList      from './components/group_menu/group_member/GroupMemberList.vue';
import GroupMemberDetail    from './components/group_menu/group_member/GroupMemberDetail.vue';
// wating member list
import WaitingMemberList     from './components/group_menu/group_member/WaitingMemberList.vue';

// Admin pages
import Record from './components/Views/Overview.vue'
import UserProfile from './components/Views/UserProfile.vue'
import TableList from './components/Views/TableList.vue'
import Typography from './components/Views/Typography.vue'
import Icons from './components/Views/Icons.vue'
import Maps from './components/Views/Maps.vue'
import Notifications from './components/Views/Notifications.vue'



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
                path: 'typography',
                name: 'Typography',
                component: Typography
            },
            {
                path: 'icons',
                name: 'Icons',
                component: Icons
            },
            {
                path: 'maps',
                name: 'Maps',
                component: Maps
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
                                    map         : GroupPlanMap,
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
